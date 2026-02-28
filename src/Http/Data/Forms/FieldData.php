<?php

namespace Narsil\Cms\Form\Http\Data\Forms;

#region USE

use Illuminate\Support\Facades\Config;
use Narsil\Base\Http\Data\Forms\FieldData as BaseFieldData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Cms\Form\Models\Element;
use Narsil\Cms\Form\Models\Input;

#endregionx

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FieldData extends BaseFieldData
{
    #region PUBLIC METHODS

    /**
     * Get the field data of an element.
     *
     * @param Element $element
     *
     * @return FieldData
     */
    public static function fromElement(Element $element): FieldData
    {
        $base = $element->{Element::RELATION_BASE};

        $input = Config::get('narsil.fields.' . $base->{Input::TYPE}, TextInputData::class);

        return new FieldData(
            id: $element->{Element::HANDLE} ?? $base->{Input::HANDLE},
            label: $element->{Element::LABEL} ?? $base->{Input::LABEL},
            description: $element->{Element::DESCRIPTION} ?? $base->{Input::DESCRIPTION},
            required: $element->{Element::REQUIRED},
            width: $element->{Element::WIDTH},
            input: new $input()
                ->options($base->{Input::RELATION_OPTIONS}),
        );
    }

    #endregion
}
