<?php

namespace Narsil\Cms\Form\Database\Factories\Forms;

#region USE

use Narsil\Cms\Form\Database\Factories\Fieldsets\PersonalInformationFieldset;
use Narsil\Cms\Form\Database\Factories\Inputs\MessageInput;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Models\Collections\Template;
use Narsil\Cms\Models\Collections\TemplateTab;
use Narsil\Cms\Models\Collections\TemplateTabElement;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
abstract class ContactForm
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
     * @return Template
     */
    public static function run(): Template
    {
        if ($field = Template::firstWhere(Template::TABLE_NAME, 'contact'))
        {
            return $field;
        }

        $messageInput = MessageInput::run();
        $personalInformationfieldset = PersonalInformationFieldset::run();

        return Form::factory()
            ->has(
                FormStep::factory()->state([
                    FormStep::HANDLE => 'contact_content',
                    FormStep::LABEL => 'How can we help you?',
                    FormStep::POSITION => 0,
                ])->hasAttached(
                    $messageInput,
                    [
                        TemplateTabElement::HANDLE => self::MESSAGE,
                        TemplateTabElement::LABEL => 'Message',
                        TemplateTabElement::POSITION => 0,
                    ],
                    TemplateTab::RELATION_FIELDS
                ),
                FormStep::RELATION_INPUTS
            )
            ->has(
                FormStep::factory()->state([
                    FormStep::HANDLE => 'contact_informations',
                    FormStep::LABEL => 'How can we contact you back?',
                ])->hasAttached(
                    $personalInformationfieldset,
                    [
                        TemplateTabElement::HANDLE => self::PERSONAL_INFORMATION,
                        TemplateTabElement::LABEL  => 'Personal information',
                        TemplateTabElement::POSITION => 1,
                    ],
                    TemplateTab::RELATION_FIELDS
                ),
                Template::RELATION_TABS
            )
            ->create([
                Form::SLUG => 'contact',
            ]);
    }

    #endregion
}
