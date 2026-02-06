<?php

namespace Narsil\Cms\Form;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Narsil\Cms\Form\Providers\CommandServiceProvider;
use Narsil\Cms\Form\Providers\ConfigurationServiceProvider;
use Narsil\Cms\Form\Providers\FieldServiceProvider;
use Narsil\Cms\Form\Providers\FormRequestServiceProvider;
use Narsil\Cms\Form\Providers\FormServiceProvider;
use Narsil\Cms\Form\Providers\FortifyServiceProvider;
use Narsil\Cms\Form\Providers\HorizonServiceProvider;
use Narsil\Cms\Form\Providers\LocalizationServiceProvider;
use Narsil\Cms\Form\Providers\MenuServiceProvider;
use Narsil\Cms\Form\Providers\MiddlewareServiceProvider;
use Narsil\Cms\Form\Providers\MigrationServiceProvider;
use Narsil\Cms\Form\Providers\ObserverServiceProvider;
use Narsil\Cms\Form\Providers\PolicyServiceProvider;
use Narsil\Cms\Form\Providers\RelationServiceProvider;
use Narsil\Cms\Form\Providers\ResourceServiceProvider;
use Narsil\Cms\Form\Providers\RouteServiceProvider;
use Narsil\Cms\Form\Providers\TableServiceProvider;
use Narsil\Cms\Form\Providers\ViewServiceProvider;
use Nuwave\Lighthouse\LighthouseServiceProvider;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class ServiceProvider extends BaseServiceProvider
{
    #region PUBLIC METHODS

    /**
     * Boot any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Model::preventLazyLoading(!App::isProduction());
    }

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $this->registerProviders();
    }

    #endregion

    #region PROTECTED METHODS

    protected function registerProviders(): void
    {
        $this->app->register(CommandServiceProvider::class);
        $this->app->register(ConfigurationServiceProvider::class);
        $this->app->register(FieldServiceProvider::class);
        $this->app->register(FormRequestServiceProvider::class);
        $this->app->register(FormServiceProvider::class);
        $this->app->register(FortifyServiceProvider::class);
        $this->app->register(HorizonServiceProvider::class);
        $this->app->register(LighthouseServiceProvider::class);
        $this->app->register(LocalizationServiceProvider::class);
        $this->app->register(MenuServiceProvider::class);
        $this->app->register(MiddlewareServiceProvider::class);
        $this->app->register(MigrationServiceProvider::class);
        $this->app->register(ObserverServiceProvider::class);
        $this->app->register(PolicyServiceProvider::class);
        $this->app->register(RelationServiceProvider::class);
        $this->app->register(ResourceServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(TableServiceProvider::class);
        $this->app->register(ViewServiceProvider::class);
    }

    #endregion
}
