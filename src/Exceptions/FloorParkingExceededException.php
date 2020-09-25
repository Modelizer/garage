<?php

namespace Garage\Exceptions;

use Exception;

class FloorParkingExceededException extends Exception
{
    public function __construct()
    {
        parent::__construct('Floor parking has exceeded the capacity.');
    }
}
