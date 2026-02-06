<?php

namespace Narsil\Cms\Form\Implementations\Tables;

#region USE

use Narsil\Cms\Form\Enums\DataTypeEnum;
use Narsil\Cms\Form\Implementations\AbstractTable;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormWebhook;
use Narsil\Cms\Form\Services\ModelService;
use Narsil\Cms\Form\Support\TableColumn;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormTable extends AbstractTable
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

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function columns(): array
    {
        return [
            new TableColumn(
                id: Form::ID,
                visibility: true,
            ),
            new TableColumn(
                id: Form::SLUG,
                visibility: true,
            ),
            new TableColumn(
                header: ModelService::getTableLabel(FormStep::TABLE),
                id: Form::COUNT_TABS,
                type: DataTypeEnum::INTEGER->value,
                visibility: true,
            ),
            new TableColumn(
                header: ModelService::getTableLabel(FormWebhook::TABLE),
                id: Form::COUNT_WEBHOOKS,
                type: DataTypeEnum::INTEGER->value,
                visibility: true,
            ),
            new TableColumn(
                id: Form::CREATED_AT,
                visibility: true,
            ),
            new TableColumn(
                id: Form::UPDATED_AT,
                visibility: true,
            ),
        ];
    }

    #endregion
}
