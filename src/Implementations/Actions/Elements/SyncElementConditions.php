<?php

namespace Narsil\Cms\Form\Implementations\Actions\Elements;

#region USE

use Narsil\Base\Implementations\Action;
use Narsil\Cms\Form\Contracts\Actions\Elements\SyncElementConditions as Contract;
use Narsil\Cms\Form\Models\Element;
use Narsil\Cms\Models\AbstractCondition;

#endregion

/**
 * @author Jonathan Rigaux
 */
class SyncElementConditions extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(Element $element, array $conditions): Element
    {
        $element->conditions()->delete();

        $conditions = collect($conditions)
            ->map(function ($condition, $index)
            {
                $condition[AbstractCondition::POSITION] = $index;

                return $condition;
            })
            ->toArray();

        $element->conditions()->createMany($conditions);

        return $element;
    }

    #endregion
}
