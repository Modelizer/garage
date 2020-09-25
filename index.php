<?php

require "vendor/autoload.php";

use Garage\Car;
use Garage\Exceptions\FloorParkingExceededException;
use Garage\Floor;
use Garage\Garage;
use Garage\Truck;

$vehicles = [];

foreach (range(1, 15) as $carCount) {
    $vehicles[] = new Car;
}

foreach (range(1, 10) as $carCount) {
    $vehicles[] = new Truck;
}

try {
    $garage = new Garage([
        // It is possible to access floor by the array pocket as level, but then we loose track inside
        // the floor where exactly car is on which floor. So it is better to designate level inside floor.
        // Another possibility is think negative floor handling. and in near future floor changing pocket will
        // become an issue to keep track on.
        new Floor(0, 10),
        new Floor(1, 10),
    ]);

    foreach ($vehicles as $vehicle) {
        // This logic can be extracted to its own class by naming it as GarageParkingStrategy in which
        // we can control what kind of vehicle can park on which floor. Right now we are forcing cars
        // should always go on first floor due to trucks which can not be parked on first floor.
        if ($vehicle instanceof Truck) {
            $garage->vehicleArrived($vehicle, 0);

            continue;
        }

        if ($vehicle instanceof Car) {
            try {
                $garage->vehicleArrived($vehicle, 1);
            } catch (FloorParkingExceededException $exception) {
                $garage->vehicleArrived($vehicle, 0);
            }
        }
    }
} catch (Exception $exception) {
    echo $exception->getMessage();
}

