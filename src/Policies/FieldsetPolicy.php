<?php

namespace Narsil\Cms\Form\Policies;

#region USE

use Narsil\Base\Traits\Policies\IsCreatable;
use Narsil\Base\Traits\Policies\IsDeletable;
use Narsil\Base\Traits\Policies\IsUpdatable;
use Narsil\Base\Traits\Policies\IsViewable;

#endregion

/**
 * @author Jonathan Rigaux
 */
class FieldsetPolicy
{
    use IsCreatable;
    use IsDeletable;
    use IsUpdatable;
    use IsViewable;
}
