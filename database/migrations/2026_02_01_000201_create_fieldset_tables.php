<?php

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Enums\OperatorEnum;
use Narsil\Base\Models\User;
use Narsil\Base\Traits\HasSchemas;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\FieldsetElement;
use Narsil\Cms\Form\Models\FieldsetElementCondition;
use Narsil\Cms\Form\Models\Input;

#endregion

return new class extends Migration
{
    use HasSchemas;

    #region PUBLIC METHODS

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        foreach ($this->getSchemas() as $schema)
        {
            if (!Schema::hasTable("$schema." . Fieldset::TABLE))
            {
                $this->createFieldsetsTable($schema);
            }
            if (!Schema::hasTable("$schema." . FieldsetElement::TABLE))
            {
                $this->createFieldsetElementTable($schema);
            }
            if (!Schema::hasTable("$schema." . FieldsetElementCondition::TABLE))
            {
                $this->createFieldsetElementConditionsTable($schema);
            }
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        foreach ($this->getSchemas() as $schema)
        {
            Schema::dropIfExists("$schema." . FieldsetElementCondition::TABLE);
            Schema::dropIfExists("$schema." . FieldsetElement::TABLE);
            Schema::dropIfExists("$schema." . Fieldset::TABLE);
        };
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the fieldset element conditions table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createFieldsetElementConditionsTable(string $schema): void
    {
        Schema::create("$schema." . FieldsetElementCondition::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(FieldsetElementCondition::UUID)
                ->primary();
            $blueprint
                ->foreignUuid(FieldsetElementCondition::FIELDSET_ELEMENT_UUID)
                ->constrained("$schema." . FieldsetElement::TABLE, FieldsetElement::UUID)
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
     * Create the form fieldset elements table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createFieldsetElementTable(string $schema): void
    {
        Schema::create("$schema." . FieldsetElement::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(FieldsetElement::UUID)
                ->primary();
            $blueprint
                ->foreignId(FieldsetElement::OWNER_ID)
                ->constrained("$schema." . Fieldset::TABLE, Fieldset::ID)
                ->cascadeOnDelete();
            $blueprint
                ->morphs(FieldsetElement::RELATION_BASE);
            $blueprint
                ->foreignId(FieldsetElement::FIELDSET_ID)
                ->nullable()
                ->constrained("$schema." . Fieldset::TABLE, Fieldset::ID)
                ->cascadeOnDelete();
            $blueprint
                ->foreignId(FieldsetElement::INPUT_ID)
                ->nullable()
                ->constrained("$schema." . Input::TABLE, Input::ID)
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
     * Create the form fieldsets table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createFieldsetsTable(string $schema): void
    {
        Schema::create("$schema." . Fieldset::TABLE, function (Blueprint $blueprint)
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
                ->timestamp(Fieldset::UPDATED_AT);
            $blueprint
                ->foreignId(Fieldset::UPDATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
        });
    }

    #endregion
};
