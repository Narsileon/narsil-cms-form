<?php

declare(strict_types=1);

namespace Narsil\Cms\Form;

#region USE

use Illuminate\Support\Str;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Http\Data\Forms\Inputs\CheckboxInputData;
use Narsil\Base\Http\Data\Forms\Inputs\DateInputData;
use Narsil\Base\Http\Data\Forms\Inputs\DatetimeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\EmailInputData;
use Narsil\Base\Http\Data\Forms\Inputs\FileInputData;
use Narsil\Base\Http\Data\Forms\Inputs\IconInputData;
use Narsil\Base\Http\Data\Forms\Inputs\NumberInputData;
use Narsil\Base\Http\Data\Forms\Inputs\PasswordInputData;
use Narsil\Base\Http\Data\Forms\Inputs\RangeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\SelectInputData;
use Narsil\Base\Http\Data\Forms\Inputs\SwitchInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextareaInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TimeInputData;
use Narsil\Base\Implementations\Menu;
use Narsil\Base\Narsil;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Services\PermissionService;
use Narsil\Base\Support\MenuItem;
use Narsil\Cms\Form\Contracts\Actions\Elements\SyncElementConditions;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\ReplicateFieldset;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\SyncFieldsetElements;
use Narsil\Cms\Form\Contracts\Actions\Forms\ReplicateForm;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormStepElements;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormSteps;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormWebhooks;
use Narsil\Cms\Form\Contracts\Actions\Inputs\ReplicateInput;
use Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputOptions;
use Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputValidationRules;
use Narsil\Cms\Form\Contracts\Forms\FieldsetElementForm;
use Narsil\Cms\Form\Contracts\Forms\FieldsetForm;
use Narsil\Cms\Form\Contracts\Forms\FormForm;
use Narsil\Cms\Form\Contracts\Forms\FormStepElementForm;
use Narsil\Cms\Form\Contracts\Forms\FormStepForm;
use Narsil\Cms\Form\Contracts\Forms\InputForm;
use Narsil\Cms\Form\Contracts\Requests\FieldsetFormRequest;
use Narsil\Cms\Form\Contracts\Requests\FormFormRequest;
use Narsil\Cms\Form\Contracts\Requests\FormSubmissionDataFormRequest;
use Narsil\Cms\Form\Contracts\Requests\FormSubmissionFormRequest;
use Narsil\Cms\Form\Contracts\Requests\InputFormRequest;
use Narsil\Cms\Form\Definitions\FieldsetDefinition;
use Narsil\Cms\Form\Definitions\FormDefinition;
use Narsil\Cms\Form\Definitions\InputDefinition;
use Narsil\Cms\Form\Http\Data\Forms\Inputs\FormInputData;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\FieldsetElement;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormStepElement;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Models\Collections\Template;
use Narsil\Cms\Providers\NarsilServiceProvider;
use Narsil\Cms\Support\Facades\CmsSidebar;

#endregion

class ServiceProvider extends NarsilServiceProvider
{
    #region PUBLIC METHODS

    /**
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
     * @return void
     */
    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations',
        ]);
    }

    /**
     * @return void
     */
    protected function bootSidebar(): void
    {
        CmsSidebar::extend(function (Menu $menu): void
        {
            $group = trans('narsil-cms::ui.forms');

            $menu
                ->add(
                    new MenuItem(Str::afterLast(Form::TABLE, '.'))
                        ->before(Str::afterLast(Template::TABLE, '.'))
                        ->group($group)
                        ->icon('fa-solid-clipboard-list')
                        ->label(ModelService::getTableLabel(Form::TABLE))
                        ->permissions([
                            PermissionService::getName(Form::TABLE, AbilityEnum::VIEW_ANY),
                        ])
                        ->route('forms.index')
                )
                ->add(
                    new MenuItem(Str::afterLast(Fieldset::TABLE, '.'))
                        ->group($group)
                        ->icon('fa-solid-list-squares')
                        ->label(ModelService::getTableLabel(Fieldset::TABLE))
                        ->permissions([
                            PermissionService::getName(Fieldset::TABLE, AbilityEnum::VIEW_ANY),
                        ])
                        ->route('fieldsets.index')
                )
                ->add(
                    new MenuItem(Str::afterLast(Input::TABLE, '.'))
                        ->group($group)
                        ->icon('fa-solid-square-pen')
                        ->label(ModelService::getTableLabel(Input::TABLE))
                        ->permissions([
                            PermissionService::getName(Input::TABLE, AbilityEnum::VIEW_ANY),
                        ])
                        ->route('inputs.index')
                );
        });
    }

    /**
     * @return void
     */
    protected function registerDefaults(): void
    {
        $narsil = $this->app->make(Narsil::class);

        $narsil
            ->action(SyncElementConditions::class, Implementations\Actions\Elements\SyncElementConditions::class)
            ->action(ReplicateFieldset::class, Implementations\Actions\Fieldsets\ReplicateFieldset::class)
            ->action(SyncFieldsetElements::class, Implementations\Actions\Fieldsets\SyncFieldsetElements::class)
            ->action(ReplicateForm::class, Implementations\Actions\Forms\ReplicateForm::class)
            ->action(SyncFormStepElements::class, Implementations\Actions\Forms\SyncFormStepElements::class)
            ->action(SyncFormSteps::class, Implementations\Actions\Forms\SyncFormSteps::class)
            ->action(SyncFormWebhooks::class, Implementations\Actions\Forms\SyncFormWebhooks::class)
            ->modelDefinition(Form::class, FormDefinition::class)
            ->modelDefinition(Fieldset::class, FieldsetDefinition::class)
            ->modelDefinition(Input::class, InputDefinition::class)
            ->action(ReplicateInput::class, Implementations\Actions\Inputs\ReplicateInput::class)
            ->action(SyncInputOptions::class, Implementations\Actions\Inputs\SyncInputOptions::class)
            ->action(SyncInputValidationRules::class, Implementations\Actions\Inputs\SyncInputValidationRules::class)
            ->form(FieldsetElementForm::class, Implementations\Forms\FieldsetElementForm::class)
            ->form(FieldsetForm::class, Implementations\Forms\FieldsetForm::class)
            ->form(FormForm::class, Implementations\Forms\FormForm::class)
            ->form(FormStepElementForm::class, Implementations\Forms\FormStepElementForm::class)
            ->form(FormStepForm::class, Implementations\Forms\FormStepForm::class)
            ->form(InputForm::class, Implementations\Forms\InputForm::class)
            ->request(FieldsetFormRequest::class, Implementations\Requests\FieldsetFormRequest::class)
            ->request(FormFormRequest::class, Implementations\Requests\FormFormRequest::class)
            ->request(FormSubmissionDataFormRequest::class, Implementations\Requests\FormSubmissionDataFormRequest::class)
            ->request(FormSubmissionFormRequest::class, Implementations\Requests\FormSubmissionFormRequest::class)
            ->request(InputFormRequest::class, Implementations\Requests\InputFormRequest::class)
            ->field(FormInputData::TYPE, FormInputData::class)
            ->input(CheckboxInputData::TYPE, CheckboxInputData::class)
            ->input(DateInputData::TYPE, DateInputData::class)
            ->input(DatetimeInputData::TYPE, DatetimeInputData::class)
            ->input(EmailInputData::TYPE, EmailInputData::class)
            ->input(FileInputData::TYPE, FileInputData::class)
            ->input(IconInputData::TYPE, IconInputData::class)
            ->input(NumberInputData::TYPE, NumberInputData::class)
            ->input(PasswordInputData::TYPE, PasswordInputData::class)
            ->input(RangeInputData::TYPE, RangeInputData::class)
            ->input(SelectInputData::TYPE, SelectInputData::class)
            ->input(SwitchInputData::TYPE, SwitchInputData::class)
            ->input(TextareaInputData::TYPE, TextareaInputData::class)
            ->input(TextInputData::TYPE, TextInputData::class)
            ->input(TimeInputData::TYPE, TimeInputData::class)
            ->morph(FieldsetElement::class, FieldsetElement::TABLE)
            ->morph(FormStep::class, FormStep::TABLE)
            ->morph(FormStepElement::class, FormStepElement::TABLE)
            ->relation(FormInputData::TYPE);
    }

    #endregion
}
