<?php

namespace Garage;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class Truck implements VehicleContract
{
    public function type()
    {
        return 'truck';
    }
}
