<?php

namespace Narsil\Cms\Form\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\InputData;

#endregionx

/**
 * @author Jonathan Rigaux
 *
 * @property string $defaultValue The value of the "default value" attribute.
 * @property string $labelPath The value of the "label path" attribute.
 * @property string $valuePath The value of the "value path" attribute.
 */
class FormInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param string $labelPath The value of the "label path" attribute.
     * @param string $valuePath The value of the "value path" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        string $labelPath = 'label',
        string $valuePath = 'identifier',
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::LABEL_PATH, $labelPath);
        $this->set(self::VALUE_PATH, $valuePath);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "initial options" attribute.
     *
     * @var string
     */
    final public const INITIAL_OPTIONS = 'initialOptions';

    /**
     * The name of the "label path" attribute.
     *
     * @var string
     */
    final public const LABEL_PATH = 'labelPath';

    /**
     * The name of the "value path" attribute.
     *
     * @var string
     */
    final public const VALUE_PATH = 'valuePath';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'form';

    #endregion
}
