<?php

namespace Narsil\Cms\Form\Database\Seeders\Fieldsets;

#region USE

use Illuminate\Database\Seeder;
use Narsil\Cms\Form\Database\Seeders\Inputs\EmailInputSeeder;
use Narsil\Cms\Form\Database\Seeders\Inputs\NameInputSeeder;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\FieldsetElement;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
final class PersonalInformationFieldsetSeeder extends Seeder
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
    public function run(): Fieldset
    {
        if ($fieldset = Fieldset::firstWhere(Fieldset::HANDLE, 'personal_information'))
        {
            return $fieldset;
        }

        $EmailInputSeeder = new EmailInputSeeder()->run();
        $NameInputSeeder = new NameInputSeeder()->run();

        return Fieldset::factory()
            ->hasAttached(
                $NameInputSeeder,
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
                $NameInputSeeder,
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
                $EmailInputSeeder,
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
