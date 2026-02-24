<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\PesertaKuis;
use App\Models\JawabanSiswa;

#[Layout('layouts.sidebar')]
class LihatNilai extends Component
{
    public PesertaKuis $peserta;

    // ── Info kuis ─────────────────────────────────────────────────
    public string $namaKuis       = '';
    public string $deskripsi      = '';
    public string $pengajar       = '';
    public string $waktuMulai     = '';
    public string $waktuSelesai   = '';
    public int $durasiDetik       = 0;
    public int $percobaanKe       = 1;
    public ?int $maksPercobaan    = null;

    // ── Hasil ────────────────────────────────────────────────────
    public float $nilaiTotal      = 0;
    public int $totalSoal         = 0;
    public int $jumlahBenar       = 0;
    public int $jumlahSalah       = 0;
    public int $jumlahKosong      = 0;
    public float $persentase      = 0;
    public bool $isNilaiTerbaik   = false;

    // ── Detail jawaban per soal ───────────────────────────────────
    public array $detailJawaban   = [];

    public function mount(PesertaKuis $peserta): void
    {
        // Guard: hanya pemilik & harus sudah selesai
        if ($peserta->user_id !== Auth::id()) {
            abort(403);
        }
        if ($peserta->status !== 'selesai') {
            $this->redirect(route('siswa.dashboard'));
            return;
        }

        $this->peserta = $peserta;
        $kuis          = $peserta->kuis;

        $this->namaKuis     = $kuis->nama_kuis;
        $this->deskripsi    = $kuis->deskripsi ?? '';
        $this->pengajar     = $kuis->pengajar?->name ?? 'Pengajar';
        $this->percobaanKe  = $peserta->percobaan_ke;
        $this->maksPercobaan = $kuis->maks_percobaan;
        $this->nilaiTotal   = (float) $peserta->nilai_total;
        $this->isNilaiTerbaik = (bool) $peserta->is_nilai_terbaik;

        // Format waktu
        $mulai   = \Carbon\Carbon::parse($peserta->waktu_mulai);
        $selesai = \Carbon\Carbon::parse($peserta->waktu_selesai);

        $this->waktuMulai   = $mulai->format('d M Y, H:i');
        $this->waktuSelesai = $selesai->format('d M Y, H:i');
        $this->durasiDetik  = (int) $mulai->diffInSeconds($selesai);

        // Ambil soal dari kuis (urutan asli)
        $soalList       = $kuis->soal()->with('opsi')->get();
        $this->totalSoal = $soalList->count();

        // Ambil semua jawaban siswa untuk percobaan ini
        $jawabanMap = JawabanSiswa::where('peserta_kuis_id', $peserta->id)
            ->get()
            ->keyBy('soal_id');

        foreach ($soalList as $nomor => $soal) {
            $jawaban     = $jawabanMap->get($soal->id);
            $opsiDipilih = $jawaban?->jawaban_opsi_id;
            $isBenar     = (bool) ($jawaban?->is_benar ?? false);
            $isDijawab   = $opsiDipilih !== null;

            if (! $isDijawab) {
                $this->jumlahKosong++;
            } elseif ($isBenar) {
                $this->jumlahBenar++;
            } else {
                $this->jumlahSalah++;
            }

            // Kumpulkan semua opsi beserta status
            $opsiDetail = $soal->opsi->map(function ($opsi) use ($opsiDipilih) {
                return [
                    'id'        => $opsi->id,
                    'text'      => $opsi->text_opsi,
                    'benar'     => (bool) $opsi->opsi_benar,
                    'dipilih'   => $opsi->id === $opsiDipilih,
                ];
            })->toArray();

            $this->detailJawaban[] = [
                'nomor'      => $nomor + 1,
                'teks'       => $soal->teks_soal,
                'bobot'      => $soal->bobot_nilai,
                'is_benar'   => $isBenar,
                'is_dijawab' => $isDijawab,
                'nilai'      => (float) ($jawaban?->nilai_final ?? 0),
                'opsi'       => $opsiDetail,
            ];
        }

        // Hitung persentase benar dari total soal
        $this->persentase = $this->totalSoal > 0
            ? round(($this->jumlahBenar / $this->totalSoal) * 100, 1)
            : 0;
    }

    // ── Format durasi pengerjaan ──────────────────────────────────
    public function formatDurasi(int $detik): string
    {
        $m = intdiv($detik, 60);
        $s = $detik % 60;
        return $m > 0
            ? $m . ' menit ' . $s . ' detik'
            : $s . ' detik';
    }

    public function render()
    {
        return view('livewire.lihat-nilai');
    }
}