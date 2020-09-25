<?php

namespace Garage\Exceptions;

use Exception;

class ExceededGarageCapacity extends Exception
{
    public function __construct()
    {
        parent::__construct('Garage is full.');
    }
}
