<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Enums\OperatorEnum;
use Narsil\Base\Models\User;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\FieldsetElement;
use Narsil\Cms\Form\Models\FieldsetElementCondition;
use Narsil\Cms\Form\Models\Input;

#endregion

return new class() extends Migration
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable(Fieldset::TABLE))
        {
            $this->createFieldsetsTable();
        }
        if (!Schema::hasTable(FieldsetElement::TABLE))
        {
            $this->createFieldsetElementTable();
        }
        if (!Schema::hasTable(FieldsetElementCondition::TABLE))
        {
            $this->createFieldsetElementConditionsTable();
        }
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(FieldsetElementCondition::TABLE);
        Schema::dropIfExists(FieldsetElement::TABLE);
        Schema::dropIfExists(Fieldset::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return void
     */
    private function createFieldsetElementConditionsTable(): void
    {
        Schema::create(FieldsetElementCondition::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(FieldsetElementCondition::UUID)
                ->primary();
            $blueprint
                ->foreignUuid(FieldsetElementCondition::FIELDSET_ELEMENT_UUID)
                ->constrained(FieldsetElement::TABLE, FieldsetElement::UUID)
                ->cascadeOnDelete();
            $blueprint
                ->integer(FieldsetElementCondition::POSITION)
                ->default(0)
                ->index();
            $blueprint
                ->string(FieldsetElementCondition::HANDLE);
            $blueprint
                ->enum(FieldsetElementCondition::OPERATOR, OperatorEnum::values())
                ->default(OperatorEnum::EQUALS);
            $blueprint
                ->string(FieldsetElementCondition::VALUE);
        });
    }

    /**
     * @return void
     */
    private function createFieldsetElementTable(): void
    {
        Schema::create(FieldsetElement::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(FieldsetElement::UUID)
                ->primary();
            $blueprint
                ->foreignId(FieldsetElement::OWNER_ID)
                ->constrained(Fieldset::TABLE, Fieldset::ID)
                ->cascadeOnDelete();
            $blueprint
                ->morphs(FieldsetElement::RELATION_BASE);
            $blueprint
                ->foreignId(FieldsetElement::FIELDSET_ID)
                ->nullable()
                ->constrained(Fieldset::TABLE, Fieldset::ID)
                ->cascadeOnDelete();
            $blueprint
                ->foreignId(FieldsetElement::INPUT_ID)
                ->nullable()
                ->constrained(Input::TABLE, Input::ID)
                ->cascadeOnDelete();
            $blueprint
                ->string(FieldsetElement::HANDLE);
            $blueprint
                ->jsonb(FieldsetElement::LABEL);
            $blueprint
                ->jsonb(FieldsetElement::DESCRIPTION)
                ->nullable();
            $blueprint
                ->boolean(FieldsetElement::REQUIRED)
                ->default(false);
            $blueprint
                ->integer(FieldsetElement::POSITION)
                ->default(0)
                ->index();
            $blueprint
                ->smallInteger(FieldsetElement::WIDTH)
                ->default(100);
        });
    }

    /**
     * @return void
     */
    private function createFieldsetsTable(): void
    {
        Schema::create(Fieldset::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->id(Fieldset::ID);
            $blueprint
                ->string(Fieldset::HANDLE)
                ->unique();
            $blueprint
                ->jsonb(Fieldset::LABEL);
            $blueprint
                ->timestamp(Fieldset::CREATED_AT);
            $blueprint
                ->foreignId(Fieldset::CREATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
            $blueprint
                ->timestamp(Fieldset::UPDATED_AT)
                ->index();
            $blueprint
                ->foreignId(Fieldset::UPDATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
        });
    }

    #endregion
};
