<?php

declare(strict_types=1);

namespace Narsil\Cms\Form;

#region USE

use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Narsil;
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
        $this->registerDefaults();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Register the package defaults.
     *
     * @return void
     */
    protected function registerDefaults(): void
    {
        $narsil = $this->app->make(Narsil::class);

        $narsil
            ->action(\Narsil\Cms\Form\Contracts\Actions\Elements\SyncElementConditions::class, \Narsil\Cms\Form\Implementations\Actions\Elements\SyncElementConditions::class)
            ->action(\Narsil\Cms\Form\Contracts\Actions\Fieldsets\ReplicateFieldset::class, \Narsil\Cms\Form\Implementations\Actions\Fieldsets\ReplicateFieldset::class)
            ->action(\Narsil\Cms\Form\Contracts\Actions\Fieldsets\SyncFieldsetElements::class, \Narsil\Cms\Form\Implementations\Actions\Fieldsets\SyncFieldsetElements::class)
            ->action(\Narsil\Cms\Form\Contracts\Actions\Forms\ReplicateForm::class, \Narsil\Cms\Form\Implementations\Actions\Forms\ReplicateForm::class)
            ->action(\Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormStepElements::class, \Narsil\Cms\Form\Implementations\Actions\Forms\SyncFormStepElements::class)
            ->action(\Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormSteps::class, \Narsil\Cms\Form\Implementations\Actions\Forms\SyncFormSteps::class)
            ->action(\Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormWebhooks::class, \Narsil\Cms\Form\Implementations\Actions\Forms\SyncFormWebhooks::class)
            ->modelDefinition(\Narsil\Cms\Form\Models\Form::class, \Narsil\Cms\Form\Definitions\FormDefinition::class)
            ->modelDefinition(\Narsil\Cms\Form\Models\Fieldset::class, \Narsil\Cms\Form\Definitions\FieldsetDefinition::class)
            ->modelDefinition(\Narsil\Cms\Form\Models\Input::class, \Narsil\Cms\Form\Definitions\InputDefinition::class)
            ->action(\Narsil\Cms\Form\Contracts\Actions\Inputs\ReplicateInput::class, \Narsil\Cms\Form\Implementations\Actions\Inputs\ReplicateInput::class)
            ->action(\Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputOptions::class, \Narsil\Cms\Form\Implementations\Actions\Inputs\SyncInputOptions::class)
            ->action(\Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputValidationRules::class, \Narsil\Cms\Form\Implementations\Actions\Inputs\SyncInputValidationRules::class)
            ->form(\Narsil\Cms\Form\Contracts\Forms\FieldsetElementForm::class, \Narsil\Cms\Form\Implementations\Forms\FieldsetElementForm::class)
            ->form(\Narsil\Cms\Form\Contracts\Forms\FieldsetForm::class, \Narsil\Cms\Form\Implementations\Forms\FieldsetForm::class)
            ->form(\Narsil\Cms\Form\Contracts\Forms\FormForm::class, \Narsil\Cms\Form\Implementations\Forms\FormForm::class)
            ->form(\Narsil\Cms\Form\Contracts\Forms\FormStepElementForm::class, \Narsil\Cms\Form\Implementations\Forms\FormStepElementForm::class)
            ->form(\Narsil\Cms\Form\Contracts\Forms\FormStepForm::class, \Narsil\Cms\Form\Implementations\Forms\FormStepForm::class)
            ->form(\Narsil\Cms\Form\Contracts\Forms\InputForm::class, \Narsil\Cms\Form\Implementations\Forms\InputForm::class)
            ->request(\Narsil\Cms\Form\Contracts\Requests\FieldsetFormRequest::class, \Narsil\Cms\Form\Implementations\Requests\FieldsetFormRequest::class)
            ->request(\Narsil\Cms\Form\Contracts\Requests\FormFormRequest::class, \Narsil\Cms\Form\Implementations\Requests\FormFormRequest::class)
            ->request(\Narsil\Cms\Form\Contracts\Requests\FormSubmissionDataFormRequest::class, \Narsil\Cms\Form\Implementations\Requests\FormSubmissionDataFormRequest::class)
            ->request(\Narsil\Cms\Form\Contracts\Requests\FormSubmissionFormRequest::class, \Narsil\Cms\Form\Implementations\Requests\FormSubmissionFormRequest::class)
            ->request(\Narsil\Cms\Form\Contracts\Requests\InputFormRequest::class, \Narsil\Cms\Form\Implementations\Requests\InputFormRequest::class)
            ->field(\Narsil\Cms\Form\Http\Data\Forms\Inputs\FormInputData::TYPE, \Narsil\Cms\Form\Http\Data\Forms\Inputs\FormInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\CheckboxInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\CheckboxInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\DateInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\DateInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\DatetimeInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\DatetimeInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\EmailInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\EmailInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\FileInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\FileInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\NumberInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\NumberInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\PasswordInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\PasswordInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\RangeInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\RangeInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\SelectInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\SelectInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\SwitchInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\SwitchInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\TextareaInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\TextareaInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\TextInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\TextInputData::class)
            ->input(\Narsil\Base\Http\Data\Forms\Inputs\TimeInputData::TYPE, \Narsil\Base\Http\Data\Forms\Inputs\TimeInputData::class)
            ->morph(\Narsil\Cms\Form\Models\FieldsetElement::class, \Narsil\Cms\Form\Models\FieldsetElement::TABLE)
            ->morph(\Narsil\Cms\Form\Models\FormStep::class, \Narsil\Cms\Form\Models\FormStep::TABLE)
            ->morph(\Narsil\Cms\Form\Models\FormStepElement::class, \Narsil\Cms\Form\Models\FormStepElement::TABLE)
            ->relation(\Narsil\Cms\Form\Http\Data\Forms\Inputs\FormInputData::TYPE);
    }


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
                    (new MenuItem(Form::TABLE))
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
                    (new MenuItem(Fieldset::TABLE))
                        ->group($group)
                        ->icon('fieldset')
                        ->label(ModelService::getTableLabel(Fieldset::TABLE))
                        ->permissions([
                            PermissionService::getName(Fieldset::TABLE, AbilityEnum::VIEW_ANY)
                        ])
                        ->route('fieldsets.index')
                )
                ->add(
                    (new MenuItem(Input::TABLE))
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
