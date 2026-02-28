<?php

namespace Narsil\Cms\Form\Database\Factories;

#region USE

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Narsil\Cms\Form\Models\Fieldset;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FieldsetFactory extends Factory
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function definition(): array
    {
        $slug = $this->faker->slug(1);

        return [
            Fieldset::HANDLE => Str::snake($slug),
            Fieldset::LABEL => Str::headline($slug),
        ];
    }

    #endregion
}
