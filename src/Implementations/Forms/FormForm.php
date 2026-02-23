<?php

namespace Narsil\Cms\Form\Implementations\Forms;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\TableInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Implementations\Form as BaseForm;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Services\RouteService;
use Narsil\Cms\Form\Contracts\Forms\FieldsetElementForm;
use Narsil\Cms\Form\Contracts\Forms\FormForm as Contract;
use Narsil\Cms\Form\Contracts\Forms\FormStepForm;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormWebhook;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Http\Data\Forms\Inputs\RelationsInputData;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormForm extends BaseForm implements Contract
{
    #region CONSTRUCTOR

    /**
     * {@inheritDoc}
     */
    public function __construct(?Model $model = null)
    {
        parent::__construct($model);

        $this->routes(RouteService::getNames(Form::TABLE));
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        $fieldsetOptions = static::getFieldsetOptions();
        $inputOptions = static::getInputOptions();

        return [
            new FormStepData(
                id: 'definition',
                label: trans('narsil::ui.definition'),
                elements: [
                    new FieldData(
                        id: Form::SLUG,
                        required: true,
                        input: new TextInputData(),
                    ),
                    new FieldData(
                        id: Form::RELATION_WEBHOOKS,
                        label: ModelService::getTableLabel(FormWebhook::TABLE),
                        required: true,
                        input: new TableInputData(
                            columns: [
                                new FieldData(
                                    id: FormWebhook::URL,
                                    required: true,
                                    input: new TextInputData(),
                                ),
                            ],
                        ),
                    ),
                    new FieldData(
                        id: Form::RELATION_STEPS,
                        input: new RelationsInputData()
                            ->set('form', app(FormStepForm::class))
                            ->intermediate(
                                label: trans('narsil-cms::ui.page'),
                                optionLabel: FormStep::LABEL,
                                optionValue: FormStep::HANDLE,
                                relation: new FieldData(
                                    id: FormStep::RELATION_ELEMENTS,
                                    input: new RelationsInputData()
                                        ->set('form', app(FieldsetElementForm::class))
                                        ->addOption(
                                            identifier: Fieldset::TABLE,
                                            label: ModelService::getModelLabel(Fieldset::TABLE),
                                            optionLabel: Fieldset::LABEL,
                                            optionValue: Fieldset::HANDLE,
                                            options: $fieldsetOptions,
                                            routes: RouteService::getNames(Fieldset::TABLE),
                                        )
                                        ->addOption(
                                            identifier: Input::TABLE,
                                            label: ModelService::getModelLabel(Input::TABLE),
                                            optionLabel: Input::LABEL,
                                            optionValue: Input::HANDLE,
                                            options: $inputOptions,
                                            routes: RouteService::getNames(Input::TABLE),
                                        ),
                                ),
                            ),
                    ),
                ],
            ),
        ];
    }

    /**
     * Get the fieldset options.
     *
     * @return OptionData[]
     */
    protected static function getFieldsetOptions(): array
    {
        return Fieldset::query()
            ->orderBy(Fieldset::LABEL)
            ->get()
            ->map(function (Fieldset $input)
            {
                $option = new OptionData(
                    label: $input->getTranslations(Fieldset::LABEL),
                    value: $input->{Fieldset::HANDLE},
                )
                    ->icon($input->{Fieldset::ATTRIBUTE_ICON})
                    ->id($input->{Fieldset::ID})
                    ->identifier($input->{Fieldset::ATTRIBUTE_IDENTIFIER});

                return $option;
            })
            ->toArray();
    }
    /**
     * Get the input options.
     *
     * @return OptionData[]
     */
    protected static function getInputOptions(): array
    {
        return Input::query()
            ->orderBy(Input::LABEL)
            ->get()
            ->map(function (Input $input)
            {
                $option = new OptionData(
                    label: $input->getTranslations(Input::LABEL),
                    value: $input->{Input::HANDLE},
                )
                    ->icon($input->{Input::ATTRIBUTE_ICON})
                    ->id($input->{Input::ID})
                    ->identifier($input->{Input::ATTRIBUTE_IDENTIFIER});

                return $option;
            })
            ->toArray();
    }

    #endregion
}
