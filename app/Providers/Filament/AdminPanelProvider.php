<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Login;
use Filament\Http\Middleware\Authenticate;
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
use App\Filament\Resources\AsmenResource;
use App\Filament\Resources\DataCsResource;
use App\Filament\Resources\DataCssResource;
use App\Filament\Resources\DetailLolosResource;
use App\Filament\Resources\FormResource;
use App\Filament\Resources\GarduResource;
use App\Filament\Resources\GerbangResource;
use App\Filament\Resources\GolKdrResource;
use App\Filament\Resources\InstansiResource;
use App\Filament\Resources\RekapResource;
use App\Filament\Resources\ShiftResource;
use App\Filament\Resources\TarifResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\RoleResource;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard as PagesDashboard;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->sidebarCollapsibleOnDesktop(true)
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
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
                        ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.dashboard')),
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

                    NavigationGroup::make('Setting')
                    ->items([
                        ...UserResource::getNavigationItems(),
                        ...RoleResource::getNavigationItems(),
                ]),
            ]);
        });
    }
}
