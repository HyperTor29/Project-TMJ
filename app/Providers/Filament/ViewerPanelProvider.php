<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard as PagesDashboard;
use App\Filament\Viewer\Resources\DataCsResource;
use App\Filament\Viewer\Resources\DataCssResource;
use App\Filament\Viewer\Resources\AsmenResource;
use App\Filament\Viewer\Resources\FormResource;
use App\Filament\Viewer\Resources\RekapResource;
use App\Filament\Viewer\Resources\GarduResource;
use App\Filament\Viewer\Resources\GerbangResource;
use App\Filament\Viewer\Resources\GolKdrResource;
use App\Filament\Viewer\Resources\InstansiResource;
use App\Filament\Viewer\Resources\ShiftResource;
use App\Filament\Viewer\Resources\TarifResource;
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

class ViewerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->sidebarCollapsibleOnDesktop(true)
            ->darkMode(false)
            ->brandLogo(asset('images/GambarTMJ.jpg'))
            ->id('viewer')
            ->path('viewer')
            ->login(Login::class)
            ->viteTheme('resources/css/filament/viewer/theme.css')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Viewer/Resources'), for: 'App\\Filament\\Viewer\\Resources')
            ->discoverPages(in: app_path('Filament/Viewer/Pages'), for: 'App\\Filament\\Viewer\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Viewer/Widgets'), for: 'App\\Filament\\Viewer\\Widgets')
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
                        ->url(fn (): string => PagesDashboard::getUrl())
                        ->icon('heroicon-o-home')
                        ->isActiveWhen(fn () => request()->routeIs('filament.viewer.pages.dashboard')),
                    ]),

                    NavigationGroup::make('Data Pegawai')
                    ->items([
                        ...DataCsResource::getNavigationItems(),
                        ...DataCssResource::getNavigationItems(),
                        ...AsmenResource::getNavigationItems(),
                    ]),

                    NavigationGroup::make('Laporan')
                    ->items([
                        ...FormResource::getNavigationItems(),
                        ...RekapResource::getNavigationItems(),
                    ]),

                    NavigationGroup::make('Operasional')
                    ->items([
                        ...GarduResource::getNavigationItems(),
                        ...GerbangResource::getNavigationItems(),
                        ...GolKdrResource::getNavigationItems(),
                        ...InstansiResource::getNavigationItems(),
                        ...ShiftResource::getNavigationItems(),
                        ...TarifResource::getNavigationItems(),
                ]),
            ]);
        });
    }
}

