<?php

namespace Narsil\Cms\Form\Implementations\Forms;

#region USE

use Narsil\Cms\Contracts\Fields\SwitchField;
use Narsil\Cms\Contracts\Fields\TextField;
use Narsil\Cms\Contracts\Forms\ConditionForm;
use Narsil\Cms\Form\Contracts\Forms\FormStepElementForm as Contract;
use Narsil\Cms\Form\Models\FormStepElement;
use Narsil\Cms\Implementations\AbstractForm;
use Narsil\Cms\Models\Collections\Field;
use Narsil\Cms\Models\Collections\TemplateTab;
use Narsil\Cms\Models\Collections\TemplateTabElement;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormStepElementForm extends AbstractForm implements Contract
{
    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getTabs(): array
    {
        return [
            [
                TemplateTab::HANDLE => 'definition',
                TemplateTab::LABEL => trans('narsil-cms::ui.definition'),
                TemplateTab::RELATION_ELEMENTS => [
                    [
                        TemplateTabElement::HANDLE => FormStepElement::HANDLE,
                        TemplateTabElement::LABEL => trans('narsil-cms::validation.attributes.handle'),
                        TemplateTabElement::REQUIRED => true,
                        TemplateTabElement::RELATION_BASE => [
                            Field::TYPE => TextField::class,
                            Field::SETTINGS => app(TextField::class),
                        ],
                    ],
                    [
                        TemplateTabElement::HANDLE => FormStepElement::LABEL,
                        TemplateTabElement::LABEL => trans('narsil-cms::validation.attributes.label'),
                        TemplateTabElement::REQUIRED => true,
                        TemplateTabElement::TRANSLATABLE => true,
                        TemplateTabElement::RELATION_BASE => [
                            Field::TYPE => TextField::class,
                            Field::SETTINGS => app(TextField::class),
                        ],
                    ],
                    [
                        TemplateTabElement::HANDLE => FormStepElement::DESCRIPTION,
                        TemplateTabElement::LABEL => trans('narsil-cms::validation.attributes.description'),
                        TemplateTabElement::REQUIRED => true,
                        TemplateTabElement::TRANSLATABLE => true,
                        TemplateTabElement::RELATION_BASE => [
                            Field::TYPE => TextField::class,
                            Field::SETTINGS => app(TextField::class),
                        ],
                    ],
                    [
                        TemplateTabElement::HANDLE => FormStepElement::REQUIRED,
                        TemplateTabElement::LABEL => trans('narsil-cms::validation.attributes.required'),
                        TemplateTabElement::RELATION_BASE => [
                            Field::TYPE => SwitchField::class,
                            Field::SETTINGS => app(SwitchField::class),
                        ],
                    ],
                ],
            ],
            ...app(ConditionForm::class)->tabs,
        ];
    }

    #endregion
}
