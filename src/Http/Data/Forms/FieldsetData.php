<?php

namespace Narsil\Cms\Form\Http\Data\Forms;

#region USE

use Narsil\Base\Http\Data\Forms\FieldsetData as BaseFieldsetData;
use Narsil\Cms\Form\Models\Element;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\FieldsetElement;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 *
 * @property boolean $collapsible
 * @property boolean $virtual
 */
class FieldsetData extends BaseFieldsetData
{
    #region PUBLIC METHODS

    /**
     * Get the fieldset data of an element.
     *
     * @param Element $element
     *
     * @return FieldsetData
     */
    public static function fromElement(Element $element): FieldsetData
    {
        $base = $element->{Element::RELATION_BASE};

        return new FieldsetData(
            description: $element->{Element::DESCRIPTION} ?? $base->{Fieldset::DESCRIPTION},
            id: $element->{Element::HANDLE} ?? $base->{Fieldset::HANDLE},
            label: $element->{Element::LABEL} ?? $base->{Fieldset::LABEL},
            elements: $base->{Fieldset::RELATION_ELEMENTS}->map(function ($element)
            {
                if ($element->{FieldsetElement::BASE_TYPE} === Input::TABLE)
                {
                    return FieldData::fromElement($element);
                }
                else
                {
                    return FieldsetData::fromElement($element);
                }
            })->toArray(),
        );
    }


    #endregion
}
