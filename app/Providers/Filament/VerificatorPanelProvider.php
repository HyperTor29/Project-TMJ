<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use App\Filament\Pages\Dashboard as PagesDashboard;
use App\Filament\Resources\FormResource;
use App\Filament\Resources\RekapResource;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class VerificatorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->sidebarCollapsibleOnDesktop(true)
            ->id('verificator')
            ->path('verificator')
            ->login(Login::class)
            ->viteTheme('resources/css/filament/verificator/theme.css')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Verificator/Resources'), for: 'App\\Filament\\Verificator\\Resources')
            ->discoverPages(in: app_path('Filament/Verificator/Pages'), for: 'App\\Filament\\Verificator\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Verificator/Widgets'), for: 'App\\Filament\\Verificator\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
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
                Authenticate::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make()
                    ->items([
                        NavigationItem::make('dashboard')
                        ->label(fn (): string => __('filament-panels::pages/dashboard.title'))
                        ->url(fn (): string => Pages\Dashboard::getUrl())
                        ->icon('heroicon-o-home')
                        ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.dashboard')),
                    ]),

                    NavigationGroup::make('Laporan')
                    ->items([
                        // ...FormResource::getNavigationItems(),
                        ...RekapResource::getNavigationItems(),
                ]),
            ]);
        });
    }
}
