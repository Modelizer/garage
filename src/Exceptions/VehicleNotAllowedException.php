<?php

namespace Garage\Exceptions;

use Exception;

class VehicleNotAllowedException extends Exception
{
    public function __construct()
    {
        parent::__construct('The given vehicle is not allowed on the given floor.');
    }
}
