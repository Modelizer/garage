<?php



require "vendor/autoload.php";

use Garage\Car;
use Garage\Floor;
use Garage\Garage;
use Garage\Truck;

$vehicles = [];

foreach (range(1, 5) as $carCount) {
    $vehicles[] = new Car;
}

foreach (range(1, 5) as $carCount) {
    $vehicles[] = new Truck;
}


$groundFloor = new Floor(0, 10);
$firstFloor = new Floor(1, 10);
$garage = new Garage([
    $groundFloor,
    $firstFloor,
]);

foreach ($vehicles as $vehicle) {
    $garage->vehicleArrived($vehicle);
}

