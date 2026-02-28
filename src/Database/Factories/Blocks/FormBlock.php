<?php

namespace Narsil\Cms\Form\Database\Factories\Blocks;

#region USE

use Narsil\Cms\Database\Factories\Blocks\LayoutBlock;
use Narsil\Cms\Form\Database\Factories\Fields\FormField;
use Narsil\Cms\Models\Collections\Block;
use Narsil\Cms\Models\Collections\BlockElement;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
abstract class FormBlock
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
    public static function run(): Block
    {
        if ($block = Block::firstWhere(Block::HANDLE, 'form'))
        {
            return $block;
        }

        $formField = FormField::run();
        $layoutBlock = LayoutBlock::run();

        return Block::factory()
            ->hasAttached(
                $layoutBlock,
                [
                    BlockElement::HANDLE => self::LAYOUT,
                    BlockElement::LABEL => 'Layout',
                    BlockElement::POSITION => 0,
                ],
                Block::RELATION_BLOCKS
            )
            ->hasAttached(
                $formField,
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
