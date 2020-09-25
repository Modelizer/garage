<?php

namespace Garage;

use Garage\Exceptions\FloorParkingExceededException;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class Floor
{
    /** @var int $level */
    protected $level;

    /** @var int $maxCapacity */
    protected $maxCapacity;

    /** @var array $arrivedVehicles */
    protected $arrivedVehicles = [];

    /**
     * @param int $level
     * @param int $capacity
     */
    public function __construct($level = 0, $capacity = 1)
    {
        $this->level = $level;
        $this->maxCapacity = $capacity;
    }

    /**
     * @param \Garage\VehicleContract $vehicle
     * @return $this
     * @throws \Garage\Exceptions\FloorParkingExceededException
     */
    public function vehicleArrived(VehicleContract $vehicle)
    {
        if (! $this->checkParkingAvailability()) {
            throw new FloorParkingExceededException;
        }

        $this->arrivedVehicles[] = $vehicle;

        echo "The {$vehicle->type()} has arrived. ";
        echo "{$this->checkParkingAvailability()} parking slot(s) available on floor {$this->getLevel()}.\n";

        return $this;
    }

    /**
     * @return int|mixed
     */
    public function checkParkingAvailability()
    {
        return $this->maxCapacity - count($this->arrivedVehicles);
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return int
     */
    public function maxCapacity()
    {
        return $this->maxCapacity;
    }
}
