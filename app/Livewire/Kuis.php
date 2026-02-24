<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Models\PesertaKuis;
use App\Models\JawabanSiswa;
use App\Models\OpsiSoal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.sidebar')]
class Kuis extends Component
{
    public PesertaKuis $peserta;

    public string $namaKuis    = '';
    public string $deskripsi   = '';
    public string $pengajar    = '';
    public int $totalSoal      = 0;
    public int $durasi         = 0;
    public int $maksPercobaan  = 1;
    public int $percobaanKe    = 1;

    // ✅ FIX: Locked agar Livewire tidak reset nilai ini saat re-render
    #[Locked]
    public int $sisaDetik = 0;

    public array $soalList  = [];
    public array $jawaban   = [];

    public bool $waktuHabis = false;
    public bool $sudahKirim = false;
    public int $soalAktif   = 0;

    public function mount(PesertaKuis $peserta): void
    {
        if ($peserta->user_id !== Auth::id()) {
            abort(403);
        }

        if ($peserta->status !== 'mengerjakan') {
            $this->redirect(route('siswa.dashboard'));
            return;
        }

        $this->peserta = $peserta;
        $kuis          = $peserta->kuis;

        $this->namaKuis      = $kuis->nama_kuis;
        $this->deskripsi     = $kuis->deskripsi ?? '';
        $this->pengajar      = $kuis->pengajar?->name ?? 'Pengajar';
        $this->durasi        = $kuis->waktu_pengerjaan;
        $this->maksPercobaan = $kuis->maks_percobaan ?? 1;
        $this->percobaanKe   = $peserta->percobaan_ke;

        $soalQuery = $kuis->soal()->with('opsi');
        if ($kuis->acak_soal) {
            $soalQuery->inRandomOrder();
        }
        $soalData        = $soalQuery->get();
        $this->totalSoal = $soalData->count();

        foreach ($soalData as $soal) {
            $opsiList = $kuis->acak_opsi ? $soal->opsi->shuffle() : $soal->opsi;

            $this->soalList[] = [
                'id'    => $soal->id,
                'teks'  => $soal->teks_soal,
                'bobot' => $soal->bobot_nilai,
                'opsi'  => $opsiList->map(fn($o) => [
                    'id'   => $o->id,
                    'text' => $o->text_opsi,
                ])->toArray(),
            ];

            $this->jawaban[(string)$soal->id] = null;
        }

        // ✅ Hitung sisaDetik hanya SEKALI di mount
        // Karena #[Locked], nilai ini tidak akan ditimpa Livewire saat re-render
        $waktuSelesai    = Carbon::parse($peserta->waktu_mulai)->addMinutes($this->durasi);
        $this->sisaDetik = max(0, (int) now()->diffInSeconds($waktuSelesai, false));

        if ($this->sisaDetik <= 0) {
            $this->kirimOtomatis();
        }
    }

    public function pilihJawaban(int $soalId, int $opsiId): void
    {
        if ($this->sudahKirim || $this->waktuHabis) return;
        $this->jawaban[(string)$soalId] = $opsiId;
    }

    public function goToSoal(int $index): void
    {
        if ($index >= 0 && $index < $this->totalSoal) {
            $this->soalAktif = $index;
        }
    }

    public function kirimJawaban(): void
    {
        if ($this->sudahKirim) return;
        $this->prosesKirim();
    }

    public function kirimOtomatis(): void
    {
        if ($this->sudahKirim) return;
        $this->waktuHabis = true;
        $this->prosesKirim();
    }

    private function prosesKirim(): void
    {
        if ($this->sudahKirim) return;
        $this->sudahKirim = true;

        DB::transaction(function () {
            $nilaiTotal = 0.00;

            foreach ($this->soalList as $soalData) {
                $soalId = $soalData['id'];

                $opsiId = $this->jawaban[(string)$soalId]
                       ?? $this->jawaban[$soalId]
                       ?? null;

                $isBenar    = false;
                $nilaiFinal = 0.00;

                if ($opsiId) {
                    $isBenar = OpsiSoal::where('id', $opsiId)
                        ->where('opsi_benar', true)
                        ->exists();

                    if ($isBenar) {
                        $nilaiFinal  = (float) $soalData['bobot'];
                        $nilaiTotal += $nilaiFinal;
                    }
                }

                JawabanSiswa::create([
                    'peserta_kuis_id' => $this->peserta->id,
                    'soal_id'         => $soalId,
                    'jawaban_opsi_id' => $opsiId,
                    'nilai_final'     => $nilaiFinal,
                    'is_benar'        => $isBenar,
                ]);
            }

            $this->peserta->update([
                'nilai_total'      => $nilaiTotal,
                'waktu_selesai'    => now(),
                'status'           => 'selesai',
                'is_nilai_terbaik' => $this->hitungNilaiTerbaik($nilaiTotal),
            ]);
        });
    }

    private function hitungNilaiTerbaik(float $nilaiTotal): bool
    {
        $nilaiSebelumnya = PesertaKuis::where('kuis_id', $this->peserta->kuis_id)
            ->where('user_id', Auth::id())
            ->where('id', '!=', $this->peserta->id)
            ->where('status', 'selesai')
            ->max('nilai_total');

        if ($nilaiSebelumnya === null || $nilaiTotal >= (float) $nilaiSebelumnya) {
            PesertaKuis::where('kuis_id', $this->peserta->kuis_id)
                ->where('user_id', Auth::id())
                ->where('id', '!=', $this->peserta->id)
                ->update(['is_nilai_terbaik' => false]);

            return true;
        }

        return false;
    }

    public function kembaliDashboard(): void
    {
        $this->redirect(route('siswa.dashboard'));
    }

    public function render()
    {
        return view('livewire.kuis');
    }
}