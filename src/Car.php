<?php

namespace Garage;

/**
 * @author Mohammed Mudassir <hello@mudasir.me>
 */
class Car implements VehicleContract
{
    public function type()
    {
        return 'car';
    }
}
