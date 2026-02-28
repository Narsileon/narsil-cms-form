<?php

namespace Narsil\Cms\Form\Database\Factories\Fieldsets;

#region USE

use Narsil\Cms\Form\Database\Factories\Inputs\EmailInput;
use Narsil\Cms\Form\Database\Factories\Inputs\NameInput;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\FieldsetElement;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
abstract class PersonalInformationFieldset
{
    #region CONSTANTS

    /**
     * The name of the "email" input.
     *
     * @var string
     */
    public const EMAIL = 'email';

    /**
     * The name of the "first name" input.
     *
     * @var string
     */
    public const FIRST_NAME = 'first_name';

    /**
     * The name of the "last name" input.
     *
     * @var string
     */
    public const LAST_NAME = 'last_name';

    #endregion

    #region PUBLIC METHODS

    /**
     * @return Fieldset
     */
    public static function run(): Fieldset
    {
        if ($block = Fieldset::firstWhere(Fieldset::HANDLE, 'personal_information'))
        {
            return $block;
        }

        $emailInput = EmailInput::run();
        $nameInput = NameInput::run();

        return Fieldset::factory()
            ->hasAttached(
                $nameInput,
                [
                    FieldsetElement::HANDLE => self::FIRST_NAME,
                    FieldsetElement::LABEL => 'First name',
                    FieldsetElement::POSITION => 0,
                    FieldsetElement::REQUIRED => true,
                    FieldsetElement::WIDTH => 50,
                ],
                Fieldset::RELATION_INPUTS
            )
            ->hasAttached(
                $nameInput,
                [
                    FieldsetElement::HANDLE => self::LAST_NAME,
                    FieldsetElement::LABEL  => 'Last mame',
                    FieldsetElement::POSITION => 1,
                    FieldsetElement::REQUIRED => true,
                    FieldsetElement::WIDTH => 50,
                ],
                Fieldset::RELATION_INPUTS
            )
            ->hasAttached(
                $emailInput,
                [
                    FieldsetElement::HANDLE => self::EMAIL,
                    FieldsetElement::LABEL  => 'Email',
                    FieldsetElement::POSITION => 2,
                    FieldsetElement::REQUIRED => true,
                ],
                Fieldset::RELATION_INPUTS
            )
            ->create([
                Fieldset::HANDLE => 'personal_information',
                Fieldset::LABEL => 'Personal Information',
            ]);
    }

    #endregion
}
