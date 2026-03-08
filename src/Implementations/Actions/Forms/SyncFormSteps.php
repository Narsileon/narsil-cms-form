<?php

namespace Narsil\Cms\Form\Implementations\Actions\Forms;

#region USE

use Illuminate\Support\Arr;
use Narsil\Base\Implementations\Action;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormStepElements;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormSteps as Contract;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;

#endregion

/**
 * @author Jonathan Rigaux
 */
class SyncFormSteps extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(Form $form, array $steps): Form
    {
        $uuids = [];

        foreach ($steps as $key => $step)
        {
            $formStep = FormStep::updateOrCreate([
                FormStep::FORM_ID => $form->{Form::ID},
                FormStep::HANDLE => Arr::get($step, FormStep::HANDLE),
            ], [
                FormStep::POSITION => $key,
                FormStep::LABEL => Arr::get($step, FormStep::LABEL),
            ]);

            app(SyncFormStepElements::class)
                ->run($formStep, Arr::get($step, FormStep::RELATION_ELEMENTS, []));

            $uuids[] = $formStep->{FormStep::UUID};
        }

        $form
            ->steps()
            ->whereNotIn(FormStep::UUID, $uuids)
            ->delete();

        return $form;
    }

    #endregion
}
