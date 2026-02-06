<?php

namespace Narsil\Cms\Form\Implementations\Tables;

#region USE

use Narsil\Cms\Form\Enums\DataTypeEnum;
use Narsil\Cms\Form\Implementations\AbstractTable;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Models\ValidationRule;
use Narsil\Cms\Form\Services\ModelService;
use Narsil\Cms\Form\Support\TableColumn;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputTable extends AbstractTable
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(Input::TABLE);
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
                id: Input::ID,
                visibility: true,
            ),
            new TableColumn(
                id: Input::HANDLE,
                visibility: true,
            ),
            new TableColumn(
                id: Input::LABEL,
                visibility: true,
            ),
            new TableColumn(
                id: Input::DESCRIPTION,
                visibility: false,
            ),
            new TableColumn(
                id: Input::PLACEHOLDER,
                visibility: false,
            ),
            new TableColumn(
                header: ModelService::getTableLabel(ValidationRule::TABLE),
                id: Input::COUNT_VALIDATION_RULES,
                type: DataTypeEnum::INTEGER->value,
                visibility: true,
            ),
            new TableColumn(
                id: Input::CREATED_AT,
                visibility: true,
            ),
            new TableColumn(
                id: Input::UPDATED_AT,
                visibility: true,
            ),
        ];
    }

    #endregion
}
