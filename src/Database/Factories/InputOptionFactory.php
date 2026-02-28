<?php

namespace Narsil\Cms\Form\Database\Factories;

#region USE

use Illuminate\Database\Eloquent\Factories\Factory;
use Narsil\Cms\Form\Models\InputOption;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputOptionFactory extends Factory
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function definition(): array
    {
        return [
            InputOption::LABEL => $this->faker->words(1),
            InputOption::VALUE => $this->faker->randomNumber(6),
        ];
    }

    #endregion
}
