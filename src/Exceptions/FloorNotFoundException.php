<?php

namespace Garage\Exceptions;

use Exception;

class FloorNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Given level of floor not found.');
    }
}
