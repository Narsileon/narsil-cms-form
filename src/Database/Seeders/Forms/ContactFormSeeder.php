<?php

namespace Narsil\Cms\Form\Database\Seeders\Forms;

#region USE

use Illuminate\Database\Seeder;
use Narsil\Cms\Form\Database\Seeders\Fieldsets\PersonalInformationFieldsetSeeder;
use Narsil\Cms\Form\Database\Seeders\Inputs\MessageInputSeeder;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormStepElement;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
final class ContactFormSeeder extends Seeder
{
    #region CONSTANTS

    /**
     * The name of the "message" input.
     *
     * @var string
     */
    public const MESSAGE = 'message';

    /**
     * The name of the "personal information" fieldset.
     *
     * @var string
     */
    public const PERSONAL_INFORMATION = 'personal_information';

    #endregion


    #region PUBLIC METHODS

    /**
     * @return Form
     */
    public function run(): Form
    {
        if ($form = Form::firstWhere(Form::SLUG, 'contact'))
        {
            return $form;
        }

        $MessageInputSeeder = new MessageInputSeeder()->run();
        $PersonalInformationFieldsetSeeder = new PersonalInformationFieldsetSeeder()->run();

        return Form::factory()
            ->has(
                FormStep::factory()->state([
                    FormStep::HANDLE => 'contact_content',
                    FormStep::LABEL => 'How can we help you?',
                    FormStep::POSITION => 0,
                ])->hasAttached(
                    $MessageInputSeeder,
                    [
                        FormStepElement::HANDLE => self::MESSAGE,
                        FormStepElement::LABEL => 'Message',
                        FormStepElement::POSITION => 0,
                    ],
                    FormStep::RELATION_INPUTS
                ),
                Form::RELATION_STEPS
            )
            ->has(
                FormStep::factory()->state([
                    FormStep::HANDLE => 'contact_informations',
                    FormStep::LABEL => 'How can we contact you back?',
                ])->hasAttached(
                    $PersonalInformationFieldsetSeeder,
                    [
                        FormStepElement::HANDLE => self::PERSONAL_INFORMATION,
                        FormStepElement::LABEL  => 'Personal information',
                        FormStepElement::POSITION => 1,
                    ],
                    FormStep::RELATION_FIELDSETS
                ),
                Form::RELATION_STEPS
            )
            ->create([
                Form::SLUG => 'contact',
            ]);
    }

    #endregion
}
