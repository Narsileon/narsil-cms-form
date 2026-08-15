<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Contracts\Actions\Forms;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Cms\Form\Models\Form;

#endregion

interface SyncFormWebhooks extends Action
{
    #region PUBLIC METHODS

    /**
     * @param Form $form
     * @param array $webhooks
     *
     * @return Form
     */
    public function run(Form $form, array $webhooks): Form;

    #endregion
}
