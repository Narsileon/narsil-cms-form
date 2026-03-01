<?php

namespace Narsil\Cms\Form;

#region USE

use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Services\PermissionService;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Implementations\Menu;
use Narsil\Cms\Models\Collections\Template;
use Narsil\Cms\Providers\NarsilServiceProvider;
use Narsil\Cms\Support\Facades\Sidebar;
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
        $this->mergeConfigFrom(__DIR__ . '/../config/bindings/forms.php', 'narsil.bindings.forms');
        $this->mergeConfigFrom(__DIR__ . '/../config/bindings/requests.php', 'narsil.bindings.requests');
        $this->mergeConfigFrom(__DIR__ . '/../config/inputs.php', 'narsil.inputs');
        $this->mergeConfigFrom(__DIR__ . '/../config/models/morphs.php', 'narsil.models.morphs');
        $this->mergeConfigFrom(__DIR__ . '/../config/models/observers.php', 'narsil.models.observers');
        $this->mergeConfigFrom(__DIR__ . '/../config/models/policies.php', 'narsil.models.policies');
        $this->mergeConfigFrom(__DIR__ . '/../config/models/tables.php', 'narsil.models.tables');
        $this->mergeConfigFrom(__DIR__ . '/../config/relations.php', 'narsil.relations');
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
        Sidebar::extend(function (Menu $menu): void
        {
            $group = trans('narsil-cms::ui.forms');

            $menu
                ->add(
                    new MenuItem(Form::TABLE)
                        ->before(Template::TABLE)
                        ->group($group)
                        ->icon('form')
                        ->label(ModelService::getTableLabel(Form::TABLE))
                        ->permissions([
                            PermissionService::getName(Form::TABLE, AbilityEnum::VIEW_ANY)
                        ])
                        ->route('forms.index')
                )
                ->add(
                    new MenuItem(Fieldset::TABLE)
                        ->group($group)
                        ->icon('fieldset')
                        ->label(ModelService::getTableLabel(Fieldset::TABLE))
                        ->permissions([
                            PermissionService::getName(Fieldset::TABLE, AbilityEnum::VIEW_ANY)
                        ])
                        ->route('fieldsets.index')
                )
                ->add(
                    new MenuItem(Input::TABLE)
                        ->group($group)
                        ->icon('input')
                        ->label(ModelService::getTableLabel(Input::TABLE))
                        ->permissions([
                            PermissionService::getName(Input::TABLE, AbilityEnum::VIEW_ANY)
                        ])
                        ->route('inputs.index')
                );
        });
    }

    #endregion
}
