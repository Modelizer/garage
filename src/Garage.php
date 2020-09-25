<?php

namespace Garage;

use Exception;
use Garage\Exceptions\ExceededGarageCapacity;
use Garage\Exceptions\FloorNotFoundException;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class Garage
{
    /** @var int $maxCapacity */
    protected $maxCapacity = 0;

    /** @var int $parkedVehiclesCount */
    protected $parkedVehiclesCount = 0;

    /** @var \Garage\Floor[] $floors */
    protected $floors = [];

    /**
     * @param array $floors
     * @throws \Exception
     */
    public function __construct(array $floors)
    {
        foreach ($floors as $floor) {
            // Here we can do validation before putting floors into Garage. It is possible user might pass
            // objects other than floor.
            if (! $floor instanceof Floor) {
                throw new Exception('Only floor objects are allowed while initialising garage.');
            }

            $this->floors[] = $floor;
            $this->maxCapacity += $floor->maxCapacity();
        }
    }

    /**
     * @param \Garage\VehicleContract $vehicle
     * @param int $floorLevel
     * @return $this
     * @throws \Garage\Exceptions\ExceededGarageCapacity
     * @throws \Garage\Exceptions\FloorNotFoundException
     * @throws \Garage\Exceptions\FloorParkingExceededException
     */
    public function vehicleArrived(VehicleContract $vehicle, $floorLevel = 0)
    {
        // The purpose of keeping track on accumulated parking slots is to not allow
        // code to go any further when the parking garage is full.
        // In SRP it does not mean that garage can not keep track of its capacity.
        // It should be noted here that floor should take care where exactly car should be parked
        // and other complex floor related logic can be pushed into Floor class..
        if ($this->parkedVehiclesCount == $this->maxCapacity) {
            throw new ExceededGarageCapacity;
        }

        $this->getFloor($floorLevel)->vehicleArrived($vehicle);
        $this->parkedVehiclesCount++;

        return $this;
    }

    /**
     * @param int $level
     * @return \Garage\Floor
     * @throws \Garage\Exceptions\FloorNotFoundException
     */
    public function getFloor($level = 0)
    {
        foreach ($this->floors as $floor) {
            if ($floor->getLevel() == $level) {
                return $floor;
            }
        }

        throw new FloorNotFoundException;
    }
}
