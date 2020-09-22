<?php

namespace Garage;

use Garage\Exceptions\ExceededGarageCapacity;
use Garage\Exceptions\VehicleNotAllowedException;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class Floor
{
    protected $level;

    protected $maxCapacity;

    protected $slot;

    public function __construct($level = 0, $capacity = 1)
    {
        $this->level = $level;
        $this->maxCapacity = $capacity;
    }

    /**
     * @return int
     */
    public function allowedCapacity()
    {
        return $this->maxCapacity;
    }

    /**
     * @return bool
     * @throws \Garage\Exceptions\VehicleNotAllowedException
     */
    public function carsAllowed()
    {
        if ($this->level != 1) {
            throw new VehicleNotAllowedException;
        }

        return true;
    }

    /**
     * @return bool
     * @throws \Garage\Exceptions\VehicleNotAllowedException
     */
    public function truckAndCarsAllowed()
    {
        return ! $this->carsAllowed();
    }

    public function vehicleHasArrived()
    {
        if ($this->maxCapacity > ($this->slot + 1)) {
            throw new ExceededGarageCapacity;
        }

        $this->slot++;

        return $this;
    }


}
