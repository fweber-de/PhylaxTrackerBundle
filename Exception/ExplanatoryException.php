<?php

namespace Ligneus\ExceptionTrackerBundle\Exception;

/**
 * @author Florian Weber <fweber@ligneus.de>
 */
class ExplanatoryException extends \Exception
{
    const MESSAGE = 0;
    const QUERY = 1;

    protected $extendedMessage;
    protected $extendedType;

    public function __construct($message, $extendedMessage = null, $type = self::MESSAGE)
    {
        $this->extendedMessage = $extendedMessage;
        $this->extendedType = $type;

        parent::__construct($message);
    }

    public function getExtendedMessage()
    {
        return $this->extendedMessage;
    }

    public function getExtendedType()
    {
        return $this->extendedType;
    }
}
