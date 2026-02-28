<?php

namespace Narsil\Cms\Form\Database\Factories;

#region USE

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputFactory extends Factory
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function definition(): array
    {
        $slug = $this->faker->slug(1);

        return [
            Input::HANDLE => Str::snake($slug),
            Input::LABEL => Str::headline($slug),
            Input::TYPE => 'text',
        ];
    }

    #endregion
}
