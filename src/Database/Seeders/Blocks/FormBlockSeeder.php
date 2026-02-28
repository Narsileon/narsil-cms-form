<?php

namespace Narsil\Cms\Form\Database\Seeders\Blocks;

#region USE

use Illuminate\Database\Seeder;
use Narsil\Cms\Database\Seeders\Blocks\LayoutBlockSeeder;
use Narsil\Cms\Form\Database\Seeders\Fields\FormFieldSeeder;
use Narsil\Cms\Models\Collections\Block;
use Narsil\Cms\Models\Collections\BlockElement;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
final class FormBlockSeeder extends Seeder
{
    #region CONSTANTS

    /**
     * The name of the "form" field.
     *
     * @var string
     */
    public const FORM = 'form';

    /**
     * The name of the "layout" block.
     *
     * @var string
     */
    public const LAYOUT = 'layout';

    #endregion

    #region PUBLIC METHODS

    /**
     * @return Block
     */
    public function run(): Block
    {
        if ($block = Block::firstWhere(Block::HANDLE, 'form'))
        {
            return $block;
        }

        $FormFieldSeeder = new FormFieldSeeder()->run();
        $LayoutBlockSeeder = new LayoutBlockSeeder()->run();

        return Block::factory()
            ->hasAttached(
                $LayoutBlockSeeder,
                [
                    BlockElement::HANDLE => self::LAYOUT,
                    BlockElement::LABEL => 'Layout',
                    BlockElement::POSITION => 0,
                ],
                Block::RELATION_BLOCKS
            )
            ->hasAttached(
                $FormFieldSeeder,
                [
                    BlockElement::HANDLE => self::FORM,
                    BlockElement::LABEL  => 'Form',
                    BlockElement::POSITION => 1,
                ],
                Block::RELATION_FIELDS
            )
            ->create([
                Block::HANDLE => 'form',
                Block::LABEL => 'Form',
            ]);
    }

    #endregion
}
