<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\PesertaKuis;
use App\Models\Kuis;
use Carbon\Carbon;

#[Layout('layouts.sidebar')]
class Dashboard extends Component
{
    public $nama;
    public $totalKuis;
    public $rataRata;
    public $nilaiTertinggi;
    public $riwayat;

    public bool $showModal      = false;
    public string $kodeInput    = '';
    public ?array $kuisInfo     = null;
    public ?string $errorPesan  = null;
    public bool $kuisValid      = false;

    public ?int $pesertaAktifId = null;

    // ── QR scan state ──────────────────────────────────────────────
    // Dipanggil dari JS setelah berhasil scan QR → kode dikirim ke Livewire
    public string $qrResult = '';

    public function mount(): void
    {
        $user = Auth::user();
        $this->nama = $user->name;

        $peserta = PesertaKuis::where('user_id', $user->id)
            ->where('status', 'selesai')
            ->get();

        $this->totalKuis      = $peserta->count();
        $this->rataRata       = $this->totalKuis > 0 ? round($peserta->avg('nilai_total')) : 0;
        $this->nilaiTertinggi = $this->totalKuis > 0 ? (int) $peserta->max('nilai_total') : 0;

        $this->riwayat = PesertaKuis::with('kuis')
            ->where('user_id', $user->id)
            ->where('status', 'selesai')
            ->orderByDesc('waktu_selesai')
            ->take(5)
            ->get();
    }

    public function bukaModal(): void
    {
        $this->showModal      = true;
        $this->pesertaAktifId = null;
    }

    public function tutupModal(): void
    {
        $this->showModal = false;
        $this->resetState();
    }

    public function resetState(): void
    {
        $this->reset(['kodeInput', 'kuisInfo', 'errorPesan', 'kuisValid', 'pesertaAktifId', 'qrResult']);
    }

    // ── Dipanggil oleh JS setelah QR berhasil di-scan ─────────────
    public function handleQrScan(string $kode): void
    {
        $this->kodeInput = strtoupper(trim($kode));
        $this->cekKode();
    }

    public function cekKode(): void
    {
        $this->reset(['kuisInfo', 'errorPesan', 'kuisValid', 'pesertaAktifId']);

        $kode = strtoupper(trim($this->kodeInput));

        if (strlen($kode) < 3) {
            $this->errorPesan = 'Kode kuis terlalu pendek.';
            return;
        }

        $kuis = Kuis::whereRaw('UPPER(kode_kuis) = ?', [$kode])->first();

        if (! $kuis) {
            $this->errorPesan = 'Kode kuis tidak ditemukan. Periksa kembali kode yang kamu masukkan.';
            return;
        }

        if ($kuis->status !== 'aktif') {
            $this->errorPesan = match ($kuis->status) {
                'draft'   => 'Kuis ini belum dipublikasikan oleh pengajar.',
                'selesai' => 'Kuis ini sudah ditutup dan tidak bisa diikuti lagi.',
                default   => 'Kuis ini tidak tersedia saat ini.',
            };
            return;
        }

        $appTz = config('app.timezone', 'Asia/Jakarta');
        $now   = Carbon::now($appTz);
        $user  = Auth::user();

        if ($kuis->mulai_dari) {
            $mulai = Carbon::parse($kuis->mulai_dari, $appTz);
            if ($now->lt($mulai)) {
                $this->errorPesan = 'Kuis belum dibuka. Dimulai pada ' . $mulai->format('d M Y, H:i') . '.';
                return;
            }
        }

        if ($kuis->akhir_pada) {
            $akhir = Carbon::parse($kuis->akhir_pada, $appTz);
            if ($now->gt($akhir)) {
                $this->errorPesan = 'Waktu pengerjaan kuis ini sudah berakhir pada ' . $akhir->format('d M Y, H:i') . '.';
                return;
            }
        }

        // ── Cek session mengerjakan yang masih aktif ──
        $sessionAktif = PesertaKuis::where('kuis_id', $kuis->id)
            ->where('user_id', $user->id)
            ->where('status', 'mengerjakan')
            ->latest()
            ->first();

        if ($sessionAktif) {
            $waktuSelesai = Carbon::parse($sessionAktif->waktu_mulai)
                ->addMinutes($kuis->waktu_pengerjaan);

            if ($now->lt($waktuSelesai)) {
                $this->pesertaAktifId = $sessionAktif->id;
                $sisaDetik = (int) $now->diffInSeconds($waktuSelesai, false);

                $this->kuisInfo = [
                    'id'               => $kuis->id,
                    'nama_kuis'        => $kuis->nama_kuis,
                    'deskripsi'        => $kuis->deskripsi,
                    'total_soal'       => $kuis->soal()->count(),
                    'waktu_pengerjaan' => $kuis->waktu_pengerjaan,
                    'percobaan_ke'     => $sessionAktif->percobaan_ke,
                    'maks_percobaan'   => $kuis->maks_percobaan,
                    'pengajar'         => $kuis->pengajar?->name ?? 'Pengajar',
                    'sisa_menit'       => ceil($sisaDetik / 60),
                    'is_lanjut'        => true,
                ];
                $this->kuisValid = true;
                return;
            } else {
                $sessionAktif->update([
                    'status'        => 'selesai',
                    'waktu_selesai' => $waktuSelesai,
                ]);
            }
        }

        // ── Cek batas percobaan ──
        $percobaan = PesertaKuis::where('kuis_id', $kuis->id)
            ->where('user_id', $user->id)
            ->where('status', 'selesai')
            ->count();

        if ($kuis->maks_percobaan && $percobaan >= $kuis->maks_percobaan) {
            $this->errorPesan = 'Kamu sudah mencapai batas maksimal percobaan untuk kuis ini (' . $kuis->maks_percobaan . 'x).';
            return;
        }

        $this->kuisInfo = [
            'id'               => $kuis->id,
            'nama_kuis'        => $kuis->nama_kuis,
            'deskripsi'        => $kuis->deskripsi,
            'total_soal'       => $kuis->soal()->count(),
            'waktu_pengerjaan' => $kuis->waktu_pengerjaan,
            'percobaan_ke'     => $percobaan + 1,
            'maks_percobaan'   => $kuis->maks_percobaan,
            'pengajar'         => $kuis->pengajar?->name ?? 'Pengajar',
            'is_lanjut'        => false,
        ];

        $this->kuisValid = true;
    }

    public function bergabungKuis(): void
    {
        if (! $this->kuisValid || ! $this->kuisInfo) {
            return;
        }

        $user = Auth::user();

        if ($this->pesertaAktifId) {
            $this->redirect(route('kuis.mulai', ['peserta' => $this->pesertaAktifId]));
            return;
        }

        $peserta = PesertaKuis::create([
            'kuis_id'          => $this->kuisInfo['id'],
            'user_id'          => $user->id,
            'nilai_total'      => 0.00,
            'waktu_mulai'      => Carbon::now(),
            'waktu_selesai'    => null,
            'status'           => 'mengerjakan',
            'percobaan_ke'     => $this->kuisInfo['percobaan_ke'],
            'is_nilai_terbaik' => false,
        ]);

        $this->redirect(route('kuis.mulai', ['peserta' => $peserta->id]));
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}