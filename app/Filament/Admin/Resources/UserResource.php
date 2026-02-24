<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Hash;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
    return $form
        ->schema([
            Section::make('Data User')
                ->schema([

                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true),

                    Select::make('role')
                        ->required()
                        ->options([
                            'admin' => 'Admin',
                            'pengajar' => 'Pengajar',
                            'siswa' => 'Siswa',
                        ]),

                    TextInput::make('password')
                        ->password()
                        ->confirmed()
                        ->required(fn ($record) => $record === null)
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->label('Password'),

                    TextInput::make('password_confirmation')
                        ->password()
                        ->label('Konfirmasi Password'),

                ])
        ]);
    }

    public static function table(Table $table): Table
    {
    return $table
        ->columns([

            TextColumn::make('id')
                ->label('ID')
                ->sortable(),

            TextColumn::make('name')
                ->label('Nama')
                ->searchable()
                ->sortable(),

            TextColumn::make('email')
                ->label('Email')
                ->searchable(),

            BadgeColumn::make('role')
                ->label('Role')
                ->colors([
                    'danger' => 'admin',     // merah
                    'warning' => 'pengajar', // kuning
                    'success' => 'siswa',    // hijau
                ])
                ->icons([
                    'heroicon-o-shield-check' => 'admin',
                    'heroicon-o-academic-cap' => 'pengajar',
                    'heroicon-o-user' => 'siswa',
                ]),

            TextColumn::make('created_at')
                ->label('Dibuat')
                ->date('d M Y')
                ->sortable(),

        ])

        ->filters([
            Tables\Filters\SelectFilter::make('role')
                ->label('Filter Role')
                ->options([
                    'admin' => 'Admin',
                    'pengajar' => 'Pengajar',
                    'siswa' => 'Siswa',
                ]),
        ])

        ->actions([
            Tables\Actions\ActionGroup::make([

            Tables\Actions\ViewAction::make()
                ->label('Lihat'),

            Tables\Actions\EditAction::make()
                ->label('Edit'),

            Tables\Actions\DeleteAction::make()
                ->label('Hapus'),

        ]),
        ])

        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
