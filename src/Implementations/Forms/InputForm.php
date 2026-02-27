<?php

namespace Narsil\Cms\Form\Implementations\Forms;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Narsil\Base\Helpers\Translator;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FieldsetData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\CheckboxInputData;
use Narsil\Base\Http\Data\Forms\Inputs\SelectInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Services\RouteService;
use Narsil\Cms\Form\Contracts\Forms\InputForm as Contract;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Models\ValidationRule;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * {@inheritDoc}
     */
    public function __construct(?Model $model = null)
    {
        parent::__construct($model);

        $this->routes(RouteService::getNames(Input::TABLE));
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        $settings = [];

        $type = request()->get(Input::TYPE);

        if ($type)
        {
            $concrete = Config::get("narsil.inputs.$type");

            $settings = $concrete::getInputForm(Input::SETTINGS);
        }

        $typeOptions = static::getTypeOptions();

        return [
            new FormStepData(
                id: 'definition',
                label: trans('narsil-cms::ui.definition'),
                elements: [
                    new FieldData(
                        description: ModelService::getAttributeDescription(Input::TABLE, Input::HANDLE),
                        id: Input::HANDLE,
                        required: true,
                        input: new TextInputData(),
                    ),
                    new FieldData(
                        description: ModelService::getAttributeDescription(Input::TABLE, Input::LABEL),
                        id: Input::LABEL,
                        required: true,
                        translatable: true,
                        input: new TextInputData(),
                    ),
                    new FieldData(
                        description: ModelService::getAttributeDescription(Input::TABLE, Input::DESCRIPTION),
                        id: Input::DESCRIPTION,
                        translatable: true,
                        input: new TextInputData(),
                    ),
                    new FieldData(
                        id: Input::TYPE,
                        required: true,
                        input: new SelectInputData(
                            options: $typeOptions,
                        )
                            ->reload('form'),
                    ),
                    ...($settings ? [
                        new FieldsetData(
                            id: Input::SETTINGS,
                            label: trans('narsil-cms::ui.settings'),
                            elements: $settings,
                        ),
                    ] : []),
                ],
            ),
            new FormStepData(
                id: 'validation',
                label: trans('narsil-cms::ui.validation'),
                elements: [
                    new FieldData(
                        id: Input::RELATION_VALIDATION_RULES,
                        label: trans('narsil-cms::ui.rules'),
                        input: new CheckboxInputData(
                            options: ValidationRule::options(),
                        ),
                    ),
                ],
            ),
        ];
    }

    /**
     * Get the type options.
     *
     * @return array<OptionData>
     */
    protected static function getTypeOptions(): array
    {
        $options = [];

        foreach (Config::get('narsil.inputs', []) as $type => $input)
        {
            $label = Translator::trans("inputs.$type");

            $options[] = new OptionData(
                value: $type,
                label: $label,
            );
        }

        return $options;
    }

    #endregion
}
