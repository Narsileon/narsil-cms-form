<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Implementations\Tables;

#region USE

use Narsil\Base\Http\Data\TanStackTables\Columns\DateTimeColumn;
use Narsil\Base\Http\Data\TanStackTables\Columns\NumberColumn;
use Narsil\Base\Http\Data\TanStackTables\Columns\TextColumn;
use Narsil\Base\Implementations\Table;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Input;

#endregion

class FieldsetTable extends Table
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(Fieldset::TABLE);
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
                id: Fieldset::ID,
                visibility: true,
            ),
            TextColumn::make(
                id: Fieldset::HANDLE,
                visibility: true,
            ),
            TextColumn::make(
                id: Fieldset::LABEL,
                visibility: true,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(Input::TABLE),
                id: Fieldset::COUNT_FIELDSETS,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(Input::TABLE),
                id: Fieldset::COUNT_INPUTS,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Fieldset::CREATED_AT,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Fieldset::UPDATED_AT,
                visibility: true,
            ),
        ];
    }

    #endregion
}
