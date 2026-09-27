<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\View\Components\Blocks\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Narsil\Cms\Form\Models\Form;

#endregion

final class InputForm extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $id
     * @param mixed $input
     * @param mixed $languages
     * @param mixed $name
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $id,
        mixed $input,
        mixed $languages = [],
        mixed $name = null,
        mixed $value = null,
    ) {
        $this->id = (string) $id;
        $this->name = (string) ($name ?? $id);
        $this->options = $this->resolveOptions((string) ($value ?? ''));
        $this->placeholder = data_get($input, 'placeholder');
        $this->required = (bool) data_get($element, 'required', false);
        $this->value = (string) ($value ?? '');
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $id;

    /**
     * @var string
     */
    public readonly string $name;

    /**
     * @var array<int,array{label:string,value:string}>
     */
    public readonly array $options;

    /**
     * @var string|null
     */
    public readonly ?string $placeholder;

    /**
     * @var boolean
     */
    public readonly bool $required;

    /**
     * @var string
     */
    public readonly string $value;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil-cms-form::components.blocks.input.input-form');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param string $value
     *
     * @return array<int,array{label:string,value:string}>
     */
    private function resolveOptions(string $value): array
    {
        $prefix = Form::TABLE . '-';

        if (!str_starts_with($value, $prefix))
        {
            return [];
        }

        $id = substr($value, strlen($prefix));

        if (!ctype_digit($id))
        {
            return [];
        }

        $form = Form::query()
            ->without(Form::RELATION_STEPS)
            ->find((int) $id);

        if (!$form)
        {
            return [];
        }

        return [[
            'label' => $form->{Form::SLUG},
            'value' => $form->{Form::ATTRIBUTE_IDENTIFIER},
        ]];
    }

    #endregion
}
