<?php

namespace Narsil\Cms\Form\Implementations\Actions\Forms;

#region USE

use Illuminate\Support\Arr;
use Narsil\Base\Implementations\Action;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormWebhooks as Contract;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormWebhook;

#endregion

/**
 * @author Jonathan Rigaux
 */
class SyncFormWebhooks extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(Form $form, array $webhooks): Form
    {
        $uuids = [];

        foreach ($webhooks as $key => $webhook)
        {
            $formWebhook = FormWebhook::updateOrCreate([
                FormWebhook::FORM_ID => $form->{Form::ID},
                FormWebhook::URL => Arr::get($webhook, FormWebhook::URL),
            ], [
                FormWebhook::POSITION => $key,
            ]);

            $uuids[] = $formWebhook->{FormWebhook::UUID};
        }

        $form
            ->webhooks()
            ->whereNotIn(FormWebhook::UUID, $uuids)
            ->delete();

        return $form;
    }

    #endregion
}
