<?php

namespace Narsil\Cms\Form\Database\Seeders\Entities;

#region USE

use Narsil\Cms\Database\Factories\Blocks\LayoutBlock;
use Narsil\Cms\Database\Factories\Blocks\PaddingBlock;
use Narsil\Cms\Database\Factories\Templates\ContentTemplate;
use Narsil\Cms\Database\Seeders\EntitySeeder;
use Narsil\Cms\Form\Database\Factories\Blocks\FormBlock;
use Narsil\Cms\Form\Database\Factories\Forms\ContactForm;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Models\Collections\Block;
use Narsil\Cms\Models\Collections\Template;
use Narsil\Cms\Models\Entities\Entity;
use Narsil\Cms\Models\Entities\EntityNode;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class ContactEntitySeeder extends EntitySeeder
{
    #region PROTECTED METHODS

    /**
     * {@inheritdoc}
     */
    protected function data(): array
    {
        $contactForm = ContactForm::run();
        $formBlock = FormBlock::run();

        return [
            ContentTemplate::CONTENT => [[
                EntityNode::BLOCK_ID => $formBlock->{Block::ID},
                EntityNode::RELATION_CHILDREN => [
                    FormBlock::LAYOUT => [
                        LayoutBlock::SIZE => 'sm',
                        LayoutBlock::PADDING => [
                            PaddingBlock::TOP => 'md',
                            PaddingBlock::BOTTOM => 'md',
                        ],
                    ],
                    FormBlock::FORM => $contactForm->{Form::ATTRIBUTE_IDENTIFIER},
                ],
            ]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function entity(): Entity
    {
        $model = $this->template->entityClass();

        return new $model([
            Entity::SLUG => 'contact',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function template(): Template
    {
        return Template::query()
            ->firstWhere(Template::TABLE_NAME, '=', 'contents');
    }

    #endregion
}
