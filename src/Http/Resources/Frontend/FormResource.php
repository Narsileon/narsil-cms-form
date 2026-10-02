<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Http\Resources\Frontend;

#region USE

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Narsil\Cms\Form\Http\Data\Forms\FormStepData;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;

#endregion

class FormResource extends JsonResource
{
    #region CONSTANTS

    /**
     * @var string
     */
    public const UUID = 'uuid';

    #endregion

    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return array<string,mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            self::UUID => Str::uuid7()->toString(),

            Form::ID => $this->resource->{Form::ID},
            Form::SLUG => $this->resource->{Form::SLUG},

            Form::RELATION_STEPS => $this->getSteps(),
        ];
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return array
     */
    private function getSteps(): array
    {
        return $this->resource->{Form::RELATION_STEPS}->map(function (FormStep $step): array
        {
            return FormStepData::fromElement($step)->toArray();
        })->all();
    }

    #endregion
}
