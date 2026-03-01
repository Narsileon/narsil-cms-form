<?php

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\User;
use Narsil\Base\Traits\HasSchemas;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Models\InputOption;
use Narsil\Cms\Form\Models\InputValidationRule;
use Narsil\Cms\Models\ValidationRule;

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
            if (!Schema::hasTable("$schema." . Input::TABLE))
            {
                $this->createInputsTable($schema);
            }
            if (!Schema::hasTable("$schema." . InputOption::TABLE))
            {
                $this->createInputOptionsTable($schema);
            }
            if (!Schema::hasTable("$schema." . InputValidationRule::TABLE))
            {
                $this->createInputValidationRuleTable($schema);
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
            Schema::dropIfExists("$schema." . InputValidationRule::TABLE);
            Schema::dropIfExists("$schema." . InputOption::TABLE);
            Schema::dropIfExists("$schema." . Input::TABLE);
        };
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the input options table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createInputOptionsTable(string $schema): void
    {
        Schema::create("$schema." . InputOption::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(InputOption::UUID)
                ->primary();
            $blueprint
                ->foreignId(InputOption::INPUT_ID)
                ->constrained("$schema." . Input::TABLE, Input::ID)
                ->cascadeOnDelete();
            $blueprint
                ->string(InputOption::VALUE);
            $blueprint
                ->jsonb(InputOption::LABEL);
            $blueprint
                ->integer(InputOption::POSITION)
                ->default(0)
                ->index();
            $blueprint
                ->timestamps();
        });
    }

    /**
     * Create the input validation rule table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createInputValidationRuleTable(string $schema): void
    {
        Schema::create("$schema." . InputValidationRule::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(InputValidationRule::UUID)
                ->primary();
            $blueprint
                ->foreignId(InputValidationRule::INPUT_ID)
                ->constrained("$schema." . Input::TABLE, Input::ID)
                ->cascadeOnDelete();
            $blueprint
                ->foreignId(InputValidationRule::VALIDATION_RULE_ID)
                ->constrained(ValidationRule::TABLE, ValidationRule::ID)
                ->cascadeOnDelete();
        });
    }

    /**
     * Create the inputs table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createInputsTable(string $schema): void
    {
        Schema::create("$schema." . Input::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->id(Input::ID);
            $blueprint
                ->string(Input::HANDLE)
                ->unique();
            $blueprint
                ->string(Input::TYPE);
            $blueprint
                ->jsonb(Input::LABEL);
            $blueprint
                ->jsonb(Input::DESCRIPTION)
                ->nullable();
            $blueprint
                ->jsonb(Input::PLACEHOLDER)
                ->nullable();
            $blueprint
                ->jsonb(Input::SETTINGS)
                ->nullable();
            $blueprint
                ->timestamp(Input::CREATED_AT);
            $blueprint
                ->foreignId(Input::CREATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
            $blueprint
                ->timestamp(Input::UPDATED_AT);
            $blueprint
                ->foreignId(Input::UPDATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
        });
    }

    #endregion
};
