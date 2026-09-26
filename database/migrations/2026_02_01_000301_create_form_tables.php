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
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormStepElement;
use Narsil\Cms\Form\Models\FormStepElementCondition;
use Narsil\Cms\Form\Models\FormSubmission;
use Narsil\Cms\Form\Models\FormWebhook;
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
        if (!Schema::hasTable(Form::TABLE))
        {
            $this->createFormsTable();
        }
        if (!Schema::hasTable(FormStep::TABLE))
        {
            $this->createFormStepsTable();
        }
        if (!Schema::hasTable(FormStepElement::TABLE))
        {
            $this->createFormStepElementTable();
        }
        if (!Schema::hasTable(FormStepElementCondition::TABLE))
        {
            $this->createFormStepElementConditionsTable();
        }
        if (!Schema::hasTable(FormSubmission::TABLE))
        {
            $this->createFormSubmissionsTable();
        }
        if (!Schema::hasTable(FormWebhook::TABLE))
        {
            $this->createFormWebhooksTable();
        }
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(FormWebhook::TABLE);
        Schema::dropIfExists(FormSubmission::TABLE);
        Schema::dropIfExists(FormStepElementCondition::TABLE);
        Schema::dropIfExists(FormStepElement::TABLE);
        Schema::dropIfExists(FormStep::TABLE);
        Schema::dropIfExists(Form::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return void
     */
    private function createFormSubmissionsTable(): void
    {
        Schema::create(FormSubmission::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(FormSubmission::UUID)
                ->primary();
            $blueprint
                ->foreignId(FormSubmission::FORM_ID)
                ->constrained(Form::TABLE, Form::ID)
                ->cascadeOnDelete();
            $blueprint
                ->json(FormSubmission::DATA);
            $blueprint
                ->timestamps();
        });
    }

    /**
     * @return void
     */
    private function createFormStepElementConditionsTable(): void
    {
        Schema::create(FormStepElementCondition::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(FormStepElementCondition::UUID)
                ->primary();
            $blueprint
                ->foreignUuid(FormStepElementCondition::FORM_STEP_ELEMENT_UUID)
                ->constrained(FormStepElement::TABLE, FormStepElement::UUID)
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
     * @return void
     */
    private function createFormStepElementTable(): void
    {
        Schema::create(FormStepElement::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(FormStepElement::UUID)
                ->primary();
            $blueprint
                ->foreignUuid(FormStepElement::OWNER_UUID)
                ->constrained(FormStep::TABLE, FormStep::UUID)
                ->cascadeOnDelete();
            $blueprint
                ->morphs(FormStepElement::RELATION_BASE);
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
     * @return void
     */
    private function createFormStepsTable(): void
    {
        Schema::create(FormStep::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(FormStep::UUID)
                ->primary();
            $blueprint
                ->foreignId(FormStep::FORM_ID)
                ->constrained(Form::TABLE, Form::ID)
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
     * @return void
     */
    private function createFormsTable(): void
    {
        Schema::create(Form::TABLE, function (Blueprint $blueprint)
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
                ->timestamp(Form::UPDATED_AT)
                ->index();
            $blueprint
                ->foreignId(Form::UPDATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
        });
    }

    /**
     * @return void
     */
    private function createFormWebhooksTable(): void
    {
        Schema::create(FormWebhook::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(FormWebhook::UUID)
                ->primary();
            $blueprint
                ->foreignId(FormWebhook::FORM_ID)
                ->constrained(Form::TABLE, Form::ID)
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
