<?php

namespace Narsil\Cms\Form\Implementations\Forms;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Services\RouteService;
use Narsil\Cms\Form\Contracts\Forms\FieldsetElementForm;
use Narsil\Cms\Form\Contracts\Forms\FieldsetForm as Contract;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\FieldsetElement;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Http\Data\Forms\Inputs\RelationsInputData;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FieldsetForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * {@inheritDoc}
     */
    public function __construct(?Model $model = null)
    {
        parent::__construct($model);

        $this->routes(RouteService::getNames(Fieldset::TABLE));
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        $inputOptions = static::getInputOptions();

        return [
            new FormStepData(
                elements: [
                    new FieldData(
                        description: ModelService::getAttributeDescription(Fieldset::TABLE, Fieldset::HANDLE),
                        id: Fieldset::HANDLE,
                        required: true,
                        input: new TextInputData(),
                    ),
                    new FieldData(
                        description: ModelService::getAttributeDescription(Fieldset::TABLE, Fieldset::LABEL),
                        id: Fieldset::LABEL,
                        required: true,
                        translatable: true,
                        input: new TextInputData(),
                    ),
                    new FieldData(
                        id: Fieldset::RELATION_ELEMENTS,
                        input: new RelationsInputData()
                            ->set('form', app(FieldsetElementForm::class))
                            ->addOption(
                                identifier: Input::TABLE,
                                label: ModelService::getModelLabel(Input::TABLE),
                                optionLabel: FieldsetElement::LABEL,
                                optionValue: FieldsetElement::HANDLE,
                                options: $inputOptions,
                                routes: RouteService::getNames(Input::TABLE),
                            ),
                    ),
                ],
            ),
        ];
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
