<?php

namespace App\Filament\Pengajar\Resources;

use App\Filament\Pengajar\Resources\KuisResource\Pages;
use App\Models\Kuis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action as TableAction;


class KuisResource extends Resource
{
    protected static ?string $model = Kuis::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Kuis';

    protected static ?string $navigationGroup = 'Manajemen Kuis';

    protected static ?string $recordTitleAttribute = 'nama_kuis';

    /* ================= FORM ================= */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make(static::getFormSteps())
                    ->columnSpanFull()
                    ->persistStepInQueryString()
                    ->nextAction(
                        fn (Action $action) => $action
                            ->label('Selanjutnya')
                            ->icon('heroicon-o-arrow-right')
                            ->iconPosition(\Filament\Support\Enums\IconPosition::After)
                    )
                    ->previousAction(
                        fn (Action $action) => $action
                            ->label('Sebelumnya')
                    )
            ]);
    }

    public static function getFormSteps(): array
    {
        return [

            /* ================= STEP 1: INFORMASI DASAR ================= */
            Step::make('Informasi Dasar')
                ->description('Detail informasi kuis')
                ->icon('heroicon-o-information-circle')
                ->schema([

                    Section::make('Identitas Kuis')
                        ->description('Informasi utama tentang kuis')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->schema([

                            TextInput::make('nama_kuis')
                                ->label('Nama Kuis')
                                ->placeholder('Contoh: Kuis Matematika Bab 1')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull()
                                ->helperText('Berikan nama yang jelas dan deskriptif'),

                            Textarea::make('deskripsi')
                                ->label('Deskripsi')
                                ->placeholder('Jelaskan tentang materi dan tujuan kuis ini...')
                                ->rows(4)
                                ->columnSpanFull()
                                ->helperText('Opsional: Tambahkan informasi detail tentang kuis'),

                            TextInput::make('kode_kuis')
                                ->label('Kode Akses')
                                ->default(fn () => Str::upper(Str::random(6)))
                                ->unique(ignoreRecord: true)
                                ->required()
                                ->maxLength(10)
                                ->prefix('🔑')
                                ->helperText('Kode unik untuk akses kuis — tidak dapat diubah')
                                ->readOnly()
                                ->suffixAction(
                                    Action::make('salinKode')
                                        ->icon('heroicon-o-clipboard-document')
                                        ->tooltip('Salin kode akses')
                                        ->alpineClickHandler("
                                            navigator.clipboard.writeText(\$el.closest('.fi-fo-field-wrp').querySelector('input').value)
                                                .then(() => {
                                                    \$dispatch('filament-notification', {
                                                        id: 'kode-disalin',
                                                        status: 'success',
                                                        title: 'Kode berhasil disalin!',
                                                    });
                                                });
                                        ")
                                ),

                            Forms\Components\Hidden::make('user_id')
                                ->default(fn () => auth()->id()),

                        ])
                        ->columns(1)
                        ->collapsible(),

                    Section::make('Status Kuis')
                        ->description('Atur status kuis agar dapat diakses oleh siswa')
                        ->icon('heroicon-o-signal')
                        ->schema([

                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'draft'   => '📝  Draft — Belum dapat diakses siswa',
                                    'aktif'   => '✅  Aktif — Siswa dapat bergabung dengan kode',
                                    'selesai' => '🔒  Selesai — Kuis ditutup, tidak bisa diikuti',
                                ])
                                ->default('draft')
                                ->required()
                                ->native(false)
                                ->columnSpanFull()
                                ->helperText('Ubah ke "Aktif" agar siswa bisa menggunakan kode kuis ini')
                                ->live()
                                ->hintIcon(fn ($state) => match($state) {
                                    'aktif'   => 'heroicon-o-check-circle',
                                    'selesai' => 'heroicon-o-x-circle',
                                    default   => 'heroicon-o-pencil',
                                })
                                ->hintColor(fn ($state) => match($state) {
                                    'aktif'   => 'success',
                                    'selesai' => 'danger',
                                    default   => 'warning',
                                })
                                ->hint(fn ($state) => match($state) {
                                    'aktif'   => 'Siswa dapat bergabung sekarang',
                                    'selesai' => 'Kuis sudah ditutup',
                                    default   => 'Kuis belum dipublikasikan',
                                }),

                        ])
                        ->columns(1)
                        ->collapsible(),

                    Section::make('Pengaturan Waktu')
                        ->description('Atur jadwal dan durasi kuis')
                        ->icon('heroicon-o-clock')
                        ->schema([

                            DateTimePicker::make('mulai_dari')
                                ->label('Mulai Dari')
                                ->native(false)
                                ->displayFormat('d/m/Y H:i')
                                ->seconds(false)
                                ->helperText('Kapan kuis mulai dapat diakses'),

                            DateTimePicker::make('akhir_pada')
                                ->label('Berakhir Pada')
                                ->native(false)
                                ->displayFormat('d/m/Y H:i')
                                ->seconds(false)
                                ->helperText('Batas waktu pengerjaan kuis'),

                            TextInput::make('waktu_pengerjaan')
                                ->label('Durasi Pengerjaan')
                                ->numeric()
                                ->default(15)
                                ->suffix('menit')
                                ->minValue(1)
                                ->helperText('Waktu maksimal untuk menyelesaikan kuis')
                                ->columnSpan(2),

                        ])
                        ->columns(2)
                        ->collapsible(),

                    Section::make('Aturan Kuis')
                        ->description('Konfigurasi aturan dan perilaku kuis')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([

                            TextInput::make('maks_percobaan')
                                ->label('Maksimal Percobaan')
                                ->numeric()
                                ->default(1)
                                ->minValue(1)
                                ->suffix('kali')
                                ->helperText('Berapa kali peserta dapat mengulang kuis'),

                            Toggle::make('is_public')
                                ->label('Kuis Publik')
                                ->inline(false)
                                ->helperText('Aktifkan agar semua orang dapat mengakses')
                                ->default(false),

                            Toggle::make('acak_soal')
                                ->label('Acak Urutan Soal')
                                ->inline(false)
                                ->helperText('Soal akan muncul dalam urutan acak')
                                ->default(false),

                            Toggle::make('acak_opsi')
                                ->label('Acak Urutan Opsi')
                                ->inline(false)
                                ->helperText('Opsi jawaban akan muncul dalam urutan acak')
                                ->default(false),

                        ])
                        ->columns(2)
                        ->collapsible(),

                ]),

            /* ================= STEP 2: SOAL-SOAL ================= */
            Step::make('Soal-soal')
                ->description('Tambahkan soal dan opsi jawaban')
                ->icon('heroicon-o-document-text')
                ->schema([

                    Section::make('Bank Soal')
                        ->description('Kelola soal-soal untuk kuis ini')
                        ->icon('heroicon-o-queue-list')
                        ->schema([

                            Repeater::make('soal')
                                ->relationship()
                                ->label('Daftar Soal')
                                ->schema([

                                    Section::make('Pertanyaan')
                                        ->icon('heroicon-o-chat-bubble-left-right')
                                        ->schema([

                                            Textarea::make('teks_soal')
                                                ->label('Teks Soal')
                                                ->placeholder('Tulis pertanyaan yang jelas dan mudah dipahami...')
                                                ->required()
                                                ->rows(3)
                                                ->columnSpan(9)
                                                ->helperText('Pastikan soal mudah dipahami oleh peserta'),

                                            TextInput::make('bobot_nilai')
                                                ->label('Bobot Nilai')
                                                ->numeric()
                                                ->default(1)
                                                ->minValue(1)
                                                ->suffix('poin')
                                                ->required()
                                                ->columnSpan(3)
                                                ->helperText('Poin yang didapat'),

                                        ])
                                        ->columns(12)
                                        ->collapsible()
                                        ->collapsed(false),

                                    Section::make('Pilihan Jawaban')
                                        ->description('Tambahkan minimal 2 opsi jawaban dan tandai yang benar')
                                        ->icon('heroicon-o-check-circle')
                                        ->schema([

                                            Repeater::make('opsi')
                                                ->relationship()
                                                ->label('')
                                                ->schema([

                                                    Grid::make(12)
                                                        ->schema([

                                                            TextInput::make('text_opsi')
                                                                ->label('Teks Opsi')
                                                                ->placeholder('Tulis pilihan jawaban...')
                                                                ->required()
                                                                ->columnSpan(9)
                                                                ->prefixIcon('heroicon-o-rectangle-stack'),

                                                            Toggle::make('opsi_benar')
                                                                ->label('Jawaban Benar')
                                                                ->inline(false)
                                                                ->columnSpan(3)
                                                                ->live()
                                                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                                    if (! $state) return;
                                                                    $opsi = $get('../../opsi') ?? [];
                                                                    foreach ($opsi as $key => $item) {
                                                                        $set("../../opsi.$key.opsi_benar", false);
                                                                    }
                                                                    $set('opsi_benar', true);
                                                                }),

                                                        ]),

                                                ])
                                                ->minItems(2)
                                                ->maxItems(5)
                                                ->defaultItems(4)
                                                ->reorderable()
                                                ->collapsible()
                                                ->collapsed(false)
                                                ->cloneable()
                                                ->itemLabel(fn (array $state): string =>
                                                    !empty($state['text_opsi'])
                                                        ? Str::limit($state['text_opsi'], 30)
                                                        : 'Opsi Baru'
                                                )
                                                ->addActionLabel('➕ Tambah Opsi Jawaban')
                                                ->deleteAction(
                                                    fn ($action) => $action
                                                        ->requiresConfirmation()
                                                        ->modalHeading('Hapus Opsi?')
                                                        ->modalDescription('Opsi ini akan dihapus dari soal.')
                                                ),

                                        ])
                                        ->collapsible()
                                        ->collapsed(false),

                                ])
                                ->defaultItems(0)
                                ->reorderable()
                                ->collapsible()
                                ->collapsed()
                                ->itemLabel(fn (array $state): string =>
                                    !empty($state['teks_soal'])
                                        ? Str::limit($state['teks_soal'], 40)
                                        : 'Soal Baru'
                                )
                                ->addActionLabel('➕ Tambah Soal Baru')
                                ->cloneable()
                                ->deleteAction(
                                    fn ($action) => $action
                                        ->requiresConfirmation()
                                        ->modalHeading('Hapus Soal?')
                                        ->modalDescription('Soal beserta semua opsi jawabannya akan dihapus.')
                                        ->modalSubmitActionLabel('Ya, Hapus')
                                )
                                ->columnSpanFull()
                                ->reorderableWithButtons(),

                        ])
                        ->collapsible(),

                ]),

        ];
    }


    /* ================= TABLE ================= */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('nama_kuis')
                    ->label('Nama Kuis')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::SemiBold)
                    ->description(fn (Kuis $record): string =>
                        $record->deskripsi
                            ? Str::limit($record->deskripsi, 50)
                            : 'Tidak ada deskripsi'
                    )
                    ->wrap(),

                // ── KODE AKSES ──────────────────────────────────────────
                Tables\Columns\TextColumn::make('kode_kuis')
                    ->label('Kode Akses')
                    ->copyable()
                    ->copyMessage('Kode berhasil disalin!')
                    ->copyMessageDuration(1500)
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->icon('heroicon-o-key'),

                Tables\Columns\TextColumn::make('soal_count')
                    ->label('Jumlah Soal')
                    ->counts('soal')
                    ->suffix(' soal')
                    ->sortable()
                    ->alignCenter()
                    ->icon('heroicon-o-list-bullet'),

                Tables\Columns\IconColumn::make('is_public')
                    ->label('Publik')
                    ->boolean()
                    ->trueIcon('heroicon-o-globe-alt')
                    ->falseIcon('heroicon-o-lock-closed')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->alignCenter()
                    ->tooltip(fn (Kuis $record): string =>
                        $record->is_public ? 'Kuis Publik' : 'Kuis Privat'
                    ),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif'   => 'success',
                        'selesai' => 'danger',
                        default   => 'warning',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'aktif'   => 'heroicon-o-check-circle',
                        'selesai' => 'heroicon-o-x-circle',
                        default   => 'heroicon-o-pencil',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'aktif'   => 'Aktif',
                        'selesai' => 'Selesai',
                        default   => 'Draft',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable()
                    ->description(fn (Kuis $record): string =>
                        $record->created_at->diffForHumans()
                    ),

            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Belum ada kuis')
            ->emptyStateDescription('Mulai buat kuis pertama Anda dengan klik tombol di bawah')
            ->emptyStateIcon('heroicon-o-clipboard-document-list')

            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft'   => 'Draft',
                        'aktif'   => 'Aktif',
                        'selesai' => 'Selesai',
                    ])
                    ->label('Status Kuis'),

                Tables\Filters\TernaryFilter::make('is_public')
                    ->label('Visibilitas')
                    ->placeholder('Semua kuis')
                    ->trueLabel('Hanya Publik')
                    ->falseLabel('Hanya Privat'),
            ])

            ->actions([

                // ── QR CODE → buka tab baru ─────────────────────────────
                TableAction::make('lihat_qr')
                    ->label('QR')
                    ->icon('heroicon-o-qr-code')
                    ->color('purple')
                    ->tooltip('Buka halaman QR Code kuis')
                    ->url(fn (Kuis $record): string => route('pengajar.kuis.qr', $record->kode_kuis))
                    ->openUrlInNewTab(),

                // ── AKSI CEPAT UBAH STATUS ───────────────────────────────
                TableAction::make('aktifkan')
                    ->label('Aktifkan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->tooltip('Ubah status ke Aktif agar siswa bisa bergabung')
                    ->visible(fn (Kuis $record): bool => $record->status !== 'aktif')
                    ->requiresConfirmation()
                    ->modalHeading('Aktifkan Kuis?')
                    ->modalDescription(fn (Kuis $record): string =>
                        'Siswa akan bisa bergabung ke "' . $record->nama_kuis . '" menggunakan kode ' . $record->kode_kuis . '.'
                    )
                    ->modalSubmitActionLabel('Ya, Aktifkan')
                    ->action(function (Kuis $record): void {
                        $record->update(['status' => 'aktif']);
                        Notification::make()
                            ->title('Kuis berhasil diaktifkan!')
                            ->body('Siswa sekarang bisa bergabung dengan kode: ' . $record->kode_kuis)
                            ->success()
                            ->send();
                    }),

                TableAction::make('tutup')
                    ->label('Tutup')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->tooltip('Tutup kuis agar tidak bisa diikuti lagi')
                    ->visible(fn (Kuis $record): bool => $record->status === 'aktif')
                    ->requiresConfirmation()
                    ->modalHeading('Tutup Kuis?')
                    ->modalDescription(fn (Kuis $record): string =>
                        'Kuis "' . $record->nama_kuis . '" akan ditutup dan siswa tidak bisa bergabung lagi.'
                    )
                    ->modalSubmitActionLabel('Ya, Tutup')
                    ->action(function (Kuis $record): void {
                        $record->update(['status' => 'selesai']);
                        Notification::make()
                            ->title('Kuis berhasil ditutup.')
                            ->warning()
                            ->send();
                    }),

                TableAction::make('ke_draft')
                    ->label('Ke Draft')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('gray')
                    ->tooltip('Kembalikan ke Draft')
                    ->visible(fn (Kuis $record): bool => $record->status === 'selesai')
                    ->action(function (Kuis $record): void {
                        $record->update(['status' => 'draft']);
                        Notification::make()
                            ->title('Kuis dikembalikan ke Draft.')
                            ->info()
                            ->send();
                    }),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil-square'),
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation(),
                ])
                ->icon('heroicon-o-ellipsis-vertical')
                ->tooltip('Aksi'),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                    Tables\Actions\BulkAction::make('bulk_aktifkan')
                        ->label('Aktifkan yang dipilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records): void {
                            $records->each(fn ($r) => $r->update(['status' => 'aktif']));
                            Notification::make()
                                ->title('Kuis berhasil diaktifkan.')
                                ->success()
                                ->send();
                        }),

                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ]);
    }

    /* ================= FILTER ================= */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id())
            ->withCount('soal');
    }

    /* ================= PAGES ================= */
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKuis::route('/'),
            'create' => Pages\CreateKuis::route('/create'),
            'edit'   => Pages\EditKuis::route('/{record}/edit'),
        ];
    }

    /* ================= NAVIGATION BADGE ================= */
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('user_id', auth()->id())->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}