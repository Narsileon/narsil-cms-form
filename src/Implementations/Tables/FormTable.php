<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Implementations\Tables;

#region USE

use Narsil\Base\Http\Data\TanStackTables\Columns\DateTimeColumn;
use Narsil\Base\Http\Data\TanStackTables\Columns\NumberColumn;
use Narsil\Base\Http\Data\TanStackTables\Columns\TextColumn;
use Narsil\Base\Implementations\Table;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormWebhook;

#endregion

class FormTable extends Table
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(Form::TABLE);
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function columns(): array
    {
        return [
            NumberColumn::make(
                id: Form::ID,
                visibility: true,
            ),
            TextColumn::make(
                id: Form::SLUG,
                visibility: true,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(FormStep::TABLE),
                id: Form::COUNT_TABS,
                visibility: true,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(FormWebhook::TABLE),
                id: Form::COUNT_WEBHOOKS,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Form::CREATED_AT,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Form::UPDATED_AT,
                visibility: true,
            ),
        ];
    }

    #endregion
}
