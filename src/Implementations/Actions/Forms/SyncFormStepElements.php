<?php

namespace Narsil\Cms\Form\Implementations\Actions\Forms;

#region USE

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Narsil\Base\Implementations\Action;
use Narsil\Cms\Form\Contracts\Actions\Elements\SyncElementConditions;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormStepElements as Contract;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormStepElement;

#endregion

/**
 * @author Jonathan Rigaux
 */
class SyncFormStepElements extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(FormStep $formStep, array $elements): FormStep
    {
        $uuids = [];

        foreach ($elements as $position => $element)
        {
            $identifier = Arr::get($element, FormStepElement::ATTRIBUTE_IDENTIFIER);

            if (!$identifier || ! Str::contains($identifier, '-'))
            {
                continue;
            }

            [$table, $id] = explode('-', $identifier);

            $formStepElement = FormStepElement::updateOrCreate([
                FormStepElement::OWNER_UUID => $formStep->{FormStep::UUID},
                FormStepElement::HANDLE => Arr::get($element, FormStepElement::HANDLE),
                FormStepElement::BASE_TYPE => $table,
                FormStepElement::BASE_ID => $id,
            ], [
                FormStepElement::DESCRIPTION => Arr::get($element, FormStepElement::DESCRIPTION),
                FormStepElement::LABEL => Arr::get($element, FormStepElement::LABEL),
                FormStepElement::POSITION => $position,
                FormStepElement::REQUIRED => Arr::get($element, FormStepElement::REQUIRED, false),
                FormStepElement::WIDTH => Arr::get($element, FormStepElement::WIDTH, 100),
            ]);

            app(SyncElementConditions::class)
                ->run($formStepElement, Arr::get($element, FormStepElement::RELATION_CONDITIONS, []));

            $uuids[] = $formStepElement->{FormStepElement::UUID};
        }

        $formStep
            ->elements()
            ->whereNotIn(FormStepElement::UUID, $uuids)
            ->delete();

        return $formStep;
    }

    #endregion
}
