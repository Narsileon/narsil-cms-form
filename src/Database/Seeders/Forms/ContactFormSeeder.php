<?php

namespace Narsil\Cms\Form\Database\Seeders\Forms;

#region USE

use Illuminate\Database\Seeder;
use Narsil\Cms\Form\Database\Seeders\Fieldsets\PersonalInformationFieldsetSeeder;
use Narsil\Cms\Form\Database\Seeders\Inputs\MessageInputSeeder;
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
        if ($form = Template::firstWhere(Template::TABLE_NAME, 'contact'))
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
                    $PersonalInformationFieldsetSeeder,
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
