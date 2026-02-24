<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Pages;
use Filament\Widgets;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;

use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;

class PengajarPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('pengajar')
            ->path('pengajar')
            ->login()

            /* ================= BRANDING ================= */
            ->brandName('WanaQuiz')
            ->favicon(asset('logo/logo-wq.png'))

            /* ================= WARNA ================= */
            ->colors([
                'primary' => Color::Purple,
                'warning' => Color::Yellow,
                'success' => Color::Green,
                'danger'  => Color::Red,
            ])

            /* ================= RESOURCE ================= */
            ->discoverResources(
                in: app_path('Filament/Pengajar/Resources'),
                for: 'App\\Filament\\Pengajar\\Resources'
            )

            ->discoverPages(
                in: app_path('Filament/Pengajar/Pages'),
                for: 'App\\Filament\\Pengajar\\Pages'
            )

            ->pages([
                Pages\Dashboard::class,
            ])

            ->discoverWidgets(
                in: app_path('Filament/Pengajar/Widgets'),
                for: 'App\\Filament\\Pengajar\\Widgets'
            )

            /* ================= MIDDLEWARE ================= */
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            ->authMiddleware([
                'auth',
                'role:pengajar',
            ]);
    }
}
