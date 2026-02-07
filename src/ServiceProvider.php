<?php

namespace Narsil\Cms\Form;

#region USE

use Narsil\Cms\Providers\NarsilServiceProvider;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class ServiceProvider extends NarsilServiceProvider
{
    #region PUBLIC METHODS

    /**
     * Boot any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'narsil-cms-form');

        $this->bootCmsRoutes(__DIR__ . '/../routes/cms.php');
        $this->bootWebRoutes(__DIR__ . '/../routes/web.php');

        $this->bootMigrations();
    }

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $this->mergeConfiguration(__DIR__ . '/../config');
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Boot the migrations.
     *
     * @return void
     */
    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations',
        ]);
    }

    #endregion
}
