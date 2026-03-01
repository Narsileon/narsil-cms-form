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
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormStepElement;
use Narsil\Cms\Form\Models\FormStepElementCondition;
use Narsil\Cms\Form\Models\FormSubmission;
use Narsil\Cms\Form\Models\FormWebhook;
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
            if (!Schema::hasTable("$schema." . Form::TABLE))
            {
                $this->createFormsTable($schema);
            }
            if (!Schema::hasTable("$schema." . FormStep::TABLE))
            {
                $this->createFormStepsTable($schema);
            }
            if (!Schema::hasTable("$schema." . FormStepElement::TABLE))
            {
                $this->createFormStepElementTable($schema);
            }
            if (!Schema::hasTable("$schema." . FormStepElementCondition::TABLE))
            {
                $this->createFormStepElementConditionsTable($schema);
            }
            if (!Schema::hasTable("$schema." . FormSubmission::TABLE))
            {
                $this->createFormSubmissionsTable($schema);
            }
            if (!Schema::hasTable("$schema." . FormWebhook::TABLE))
            {
                $this->createFormWebhooksTable($schema);
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
            Schema::dropIfExists("$schema." . FormWebhook::TABLE);
            Schema::dropIfExists("$schema." . FormSubmission::TABLE);
            Schema::dropIfExists("$schema." . FormStepElementCondition::TABLE);
            Schema::dropIfExists("$schema." . FormStepElement::TABLE);
            Schema::dropIfExists("$schema." . FormStep::TABLE);
            Schema::dropIfExists("$schema." . Form::TABLE);
        };
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the form submissions table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createFormSubmissionsTable(string $schema): void
    {
        Schema::create("$schema." . FormSubmission::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(FormSubmission::UUID)
                ->primary();
            $blueprint
                ->foreignId(FormSubmission::FORM_ID)
                ->constrained("$schema." . Form::TABLE, Form::ID)
                ->cascadeOnDelete();
            $blueprint
                ->json(FormSubmission::DATA);
            $blueprint
                ->timestamps();
        });
    }

    /**
     * Create the form step element conditions table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createFormStepElementConditionsTable(string $schema): void
    {
        Schema::create("$schema." . FormStepElementCondition::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(FormStepElementCondition::UUID)
                ->primary();
            $blueprint
                ->foreignUuid(FormStepElementCondition::FORM_STEP_ELEMENT_UUID)
                ->constrained("$schema." . FormStepElement::TABLE, FormStepElement::UUID)
                ->cascadeOnDelete();
            $blueprint
                ->integer(FieldsetElementCondition::POSITION)
                ->default(0)
                ->index();
            $blueprint
                ->string(FormStepElementCondition::HANDLE);
            $blueprint
                ->enum(FormStepElementCondition::OPERATOR, OperatorEnum::values())
                ->default(OperatorEnum::EQUALS);
            $blueprint
                ->string(FormStepElementCondition::VALUE);
        });
    }

    /**
     * Create the form step elements table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createFormStepElementTable(string $schema): void
    {
        Schema::create("$schema." . FormStepElement::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(FormStepElement::UUID)
                ->primary();
            $blueprint
                ->foreignUuid(FormStepElement::OWNER_UUID)
                ->constrained("$schema." . FormStep::TABLE, FormStep::UUID)
                ->cascadeOnDelete();
            $blueprint
                ->morphs(FormStepElement::RELATION_BASE);
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
                ->string(FormStepElement::HANDLE);
            $blueprint
                ->jsonb(FormStepElement::LABEL);
            $blueprint
                ->jsonb(FormStepElement::DESCRIPTION)
                ->nullable();
            $blueprint
                ->boolean(FormStepElement::REQUIRED)
                ->default(false);
            $blueprint
                ->integer(FormStepElement::POSITION)
                ->default(0)
                ->index();
            $blueprint
                ->smallInteger(FormStepElement::WIDTH)
                ->default(100);
        });
    }

    /**
     * Create the form steps table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createFormStepsTable(string $schema): void
    {
        Schema::create("$schema." . FormStep::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(FormStep::UUID)
                ->primary();
            $blueprint
                ->foreignId(FormStep::FORM_ID)
                ->constrained("$schema." . Form::TABLE, Form::ID)
                ->cascadeOnDelete();
            $blueprint
                ->string(FormStep::HANDLE);
            $blueprint
                ->jsonb(FormStep::LABEL);
            $blueprint
                ->jsonb(FormStep::DESCRIPTION)
                ->nullable();
            $blueprint
                ->integer(FormStep::POSITION)
                ->default(0)
                ->index();
            $blueprint
                ->timestamps();
        });
    }

    /**
     * Create the forms table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createFormsTable(string $schema): void
    {
        Schema::create("$schema." . Form::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->id(Form::ID);
            $blueprint
                ->string(Form::SLUG)
                ->unique();
            $blueprint
                ->timestamp(Form::CREATED_AT);
            $blueprint
                ->foreignId(Form::CREATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
            $blueprint
                ->timestamp(Form::UPDATED_AT);
            $blueprint
                ->foreignId(Form::UPDATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
        });
    }

    /**
     * Create the form webhooks table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createFormWebhooksTable(string $schema): void
    {
        Schema::create("$schema." . FormWebhook::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(FormWebhook::UUID)
                ->primary();
            $blueprint
                ->foreignId(FormWebhook::FORM_ID)
                ->constrained("$schema." . Form::TABLE, Form::ID)
                ->cascadeOnDelete();
            $blueprint
                ->integer(FormWebhook::POSITION)
                ->default(0)
                ->index();
            $blueprint
                ->string(FormWebhook::URL);
        });
    }

    #endregion
};
