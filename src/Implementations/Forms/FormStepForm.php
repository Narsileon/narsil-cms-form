<?php

namespace Narsil\Cms\Form\Implementations\Forms;

#region USE

use Narsil\Cms\Form\Contracts\Fields\TextField;
use Narsil\Cms\Form\Contracts\Forms\FormStepForm as Contract;
use Narsil\Cms\Form\Implementations\AbstractForm;
use Narsil\Cms\Form\Models\Collections\Field;
use Narsil\Cms\Form\Models\Collections\TemplateTab;
use Narsil\Cms\Form\Models\Collections\TemplateTabElement;
use Narsil\Cms\Form\Models\FormStep;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormStepForm extends AbstractForm implements Contract
{
    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getTabs(): array
    {
        return [
            [
                TemplateTab::RELATION_ELEMENTS => [
                    [
                        TemplateTabElement::HANDLE => FormStep::HANDLE,
                        TemplateTabElement::LABEL => trans('narsil::validation.attributes.handle'),
                        TemplateTabElement::REQUIRED => true,
                        TemplateTabElement::RELATION_BASE => [
                            Field::TYPE => TextField::class,
                            Field::SETTINGS => app(TextField::class),
                        ],
                    ],
                    [
                        TemplateTabElement::HANDLE => FormStep::LABEL,
                        TemplateTabElement::LABEL => trans('narsil::validation.attributes.label'),
                        TemplateTabElement::REQUIRED => true,
                        TemplateTabElement::TRANSLATABLE => true,
                        TemplateTabElement::RELATION_BASE => [
                            Field::TYPE => TextField::class,
                            Field::SETTINGS => app(TextField::class),
                        ],
                    ],
                    [
                        TemplateTabElement::HANDLE => FormStep::DESCRIPTION,
                        TemplateTabElement::LABEL => trans('narsil::validation.attributes.description'),
                        TemplateTabElement::TRANSLATABLE => true,
                        TemplateTabElement::RELATION_BASE => [
                            Field::TYPE => TextField::class,
                            Field::SETTINGS => app(TextField::class),
                        ]
                    ],
                ],
            ],
        ];
    }

    #endregion
}
