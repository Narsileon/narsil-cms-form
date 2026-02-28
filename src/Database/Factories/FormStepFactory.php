<?php

namespace Narsil\Cms\Form\Database\Factories;

#region USE

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Narsil\Cms\Form\Models\FormStep;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormStepFactory extends Factory
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function definition(): array
    {
        $slug = $this->faker->slug(1);

        return [
            FormStep::HANDLE => Str::snake($slug),
            FormStep::LABEL => Str::headline($slug),
        ];
    }

    #endregion
}
