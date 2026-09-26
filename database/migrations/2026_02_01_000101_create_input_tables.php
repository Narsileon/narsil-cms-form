<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\User;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Models\InputOption;
use Narsil\Cms\Form\Models\InputValidationRule;
use Narsil\Cms\Models\ValidationRule;

#endregion

return new class() extends Migration
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable(Input::TABLE))
        {
            $this->createInputsTable();
        }
        if (!Schema::hasTable(InputOption::TABLE))
        {
            $this->createInputOptionsTable();
        }
        if (!Schema::hasTable(InputValidationRule::TABLE))
        {
            $this->createInputValidationRuleTable();
        }
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(InputValidationRule::TABLE);
        Schema::dropIfExists(InputOption::TABLE);
        Schema::dropIfExists(Input::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return void
     */
    private function createInputOptionsTable(): void
    {
        Schema::create(InputOption::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(InputOption::UUID)
                ->primary();
            $blueprint
                ->foreignId(InputOption::INPUT_ID)
                ->constrained(Input::TABLE, Input::ID)
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
     * @return void
     */
    private function createInputValidationRuleTable(): void
    {
        Schema::create(InputValidationRule::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(InputValidationRule::UUID)
                ->primary();
            $blueprint
                ->foreignId(InputValidationRule::INPUT_ID)
                ->constrained(Input::TABLE, Input::ID)
                ->cascadeOnDelete();
            $blueprint
                ->foreignId(InputValidationRule::VALIDATION_RULE_ID)
                ->constrained(ValidationRule::TABLE, ValidationRule::ID)
                ->cascadeOnDelete();
        });
    }

    /**
     * @return void
     */
    private function createInputsTable(): void
    {
        Schema::create(Input::TABLE, function (Blueprint $blueprint)
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
                ->timestamp(Input::UPDATED_AT)
                ->index();
            $blueprint
                ->foreignId(Input::UPDATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
        });
    }

    #endregion
};
