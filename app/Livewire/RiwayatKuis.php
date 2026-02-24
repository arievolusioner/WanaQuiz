<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\PesertaKuis;

#[Layout('layouts.sidebar')]
class RiwayatKuis extends Component
{
    use WithPagination;

    // ── Filter & Sort ─────────────────────────────────────────────
    public string $cari      = '';
    public string $sortBy    = 'waktu_selesai';  // waktu_selesai | nilai_total
    public string $sortDir   = 'desc';
    public string $filterNilai = '';  // '' | 'tinggi' | 'sedang' | 'rendah'

    // ── Stats ringkasan ───────────────────────────────────────────
    public int $totalSelesai    = 0;
    public float $rataRata      = 0;
    public int $nilaiTertinggi  = 0;
    public int $nilaiTerendah   = 0;

    protected $queryString = [
        'cari'        => ['except' => ''],
        'sortBy'      => ['except' => 'waktu_selesai'],
        'sortDir'     => ['except' => 'desc'],
        'filterNilai' => ['except' => ''],
    ];

    public function mount(): void
    {
        $this->loadStats();
    }

    public function updatingCari(): void
    {
        $this->resetPage();
    }

    public function updatingFilterNilai(): void
    {
        $this->resetPage();
    }

    public function sortToggle(string $kolom): void
    {
        if ($this->sortBy === $kolom) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy  = $kolom;
            $this->sortDir = 'desc';
        }
        $this->resetPage();
    }

    private function loadStats(): void
    {
        $data = PesertaKuis::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->get();

        $this->totalSelesai   = $data->count();
        $this->rataRata       = $this->totalSelesai > 0 ? round($data->avg('nilai_total'), 1) : 0;
        $this->nilaiTertinggi = $this->totalSelesai > 0 ? (int) $data->max('nilai_total') : 0;
        $this->nilaiTerendah  = $this->totalSelesai > 0 ? (int) $data->min('nilai_total') : 0;
    }

    public function render()
    {
        $query = PesertaKuis::with('kuis.pengajar')
            ->where('user_id', Auth::id())
            ->where('status', 'selesai');

        // Filter pencarian nama kuis
        if ($this->cari !== '') {
            $query->whereHas('kuis', fn($q) =>
                $q->where('nama_kuis', 'like', '%' . $this->cari . '%')
            );
        }

        // Filter range nilai
        match ($this->filterNilai) {
            'tinggi'  => $query->where('nilai_total', '>=', 80),
            'sedang'  => $query->whereBetween('nilai_total', [60, 79.99]),
            'rendah'  => $query->where('nilai_total', '<', 60),
            default   => null,
        };

        // Sort
        $query->orderBy($this->sortBy, $this->sortDir);

        $riwayat = $query->paginate(10);

        return view('livewire.riwayat-kuis', [
            'riwayat' => $riwayat,
        ]);
    }
}