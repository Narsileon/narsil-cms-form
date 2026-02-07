<?php

namespace Narsil\Cms\Form;

#region USE

use Narsil\Cms\Enums\Policies\PermissionEnum;
use Narsil\Cms\Facades\Menus\Sidebar;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Providers\NarsilServiceProvider;
use Narsil\Cms\Services\ModelService;
use Narsil\Cms\Services\PermissionService;
use Narsil\Cms\Support\MenuItem;

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

        $this->app->booted(function ()
        {
            $this->bootSidebar();
        });
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

    /**
     * Boot the sidebar.
     *
     * @return void
     */
    protected function bootSidebar(): void
    {
        $group = trans('narsil-cms::ui.forms');

        Sidebar::add(new MenuItem(Form::TABLE)
            ->group($group)
            ->icon('form')
            ->label(ModelService::getTableLabel(Form::TABLE))
            ->permissions([
                PermissionService::getHandle(Form::TABLE, PermissionEnum::VIEW_ANY->value)
            ])
            ->route('forms.index'));

        Sidebar::add(new MenuItem(Fieldset::TABLE)
            ->group($group)
            ->icon('fieldset')
            ->label(ModelService::getTableLabel(Fieldset::TABLE))
            ->permissions([
                PermissionService::getHandle(Fieldset::TABLE, PermissionEnum::VIEW_ANY->value)
            ])
            ->route('fieldsets.index'));

        Sidebar::add(new MenuItem(Input::TABLE)
            ->group($group)
            ->icon('input')
            ->label(ModelService::getTableLabel(Input::TABLE))
            ->permissions([
                PermissionService::getHandle(Input::TABLE, PermissionEnum::VIEW_ANY->value)
            ])
            ->route('inputs.index'));
    }

    #endregion
}
