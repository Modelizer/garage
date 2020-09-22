<?php

namespace Garage;

use ExceededGarageCapacity;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class Garage
{
    protected $slots = 0;

    protected $maxSlotCount = 0;

    protected $vehicles = [];

    /** @var \Garage\Floor[] $floors */
    protected $floors = [];

    public function __construct(array $floors)
    {
        $this->floors = $floors;

        /** @var \Garage\Floor $floor */
        foreach ($this->floors as $floor) {
            $this->floors[] = $floor;
            $this->maxSlotCount += $floor->allowedCapacity();
        }
    }

    public function capacity(int $slot)
    {
        if ($slot + $this->slots > $this->maxSlotCount) {
            throw new Exceptions\ExceededGarageCapacity;
        }

        $this->slots += $slot;

        return $this;
    }

    /**
     * @param \Garage\VehicleContract $vehicleContract
     * @return $this
     * @throws \Garage\Exceptions\ExceededGarageCapacity
     */
    public function vehicleArrived(VehicleContract $vehicleContract)
    {
        if ($this->slots > $this->maxSlotCount) {
            throw new \Garage\Exceptions\ExceededGarageCapacity;
        }

        $this->vehicles[] = $vehicleContract;
        $this->slots++;

        if ($vehicleContract instanceof Car) {
            try {
                $this->floors[1]->vehicleHasArrived();
            } catch (\Garage\Exceptions\ExceededGarageCapacity $exception) {
                $this->floors[0]->vehicleHasArrived();
            }

            echo "Car has arrived\n";
        } else {
            $this->floors[0]->vehicleHasArrived();
            echo "Truck has arrived\n";
        }

        return $this;
    }
}
