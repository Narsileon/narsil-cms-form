<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Implementations\Tables;

#region USE

use Narsil\Base\Http\Data\TanStackTables\Columns\DateTimeColumn;
use Narsil\Base\Http\Data\TanStackTables\Columns\NumberColumn;
use Narsil\Base\Http\Data\TanStackTables\Columns\TextColumn;
use Narsil\Base\Implementations\Table;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Models\ValidationRule;

#endregion

class InputTable extends Table
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

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function columns(): array
    {
        return [
            NumberColumn::make(
                id: Input::ID,
                visibility: true,
            ),
            TextColumn::make(
                id: Input::HANDLE,
                visibility: true,
            ),
            TextColumn::make(
                id: Input::LABEL,
                visibility: true,
            ),
            TextColumn::make(
                id: Input::DESCRIPTION,
            ),
            TextColumn::make(
                id: Input::PLACEHOLDER,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(ValidationRule::TABLE),
                id: Input::COUNT_VALIDATION_RULES,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Input::CREATED_AT,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Input::UPDATED_AT,
                visibility: true,
            ),
        ];
    }

    #endregion
}
