<?php

namespace SaKanjo\FilamentFakeFillAction;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentFakeFillActionServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-fakefill-action';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasInstallCommand(
                fn (InstallCommand $command) => $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('sakanjo/filament-fakefill-action')
            );
    }

    public function bootingPackage(): void
    {
        $this->app->singleton('fakeFilling', fn () => false);
    }
}
