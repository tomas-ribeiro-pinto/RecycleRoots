<?php

namespace Tests\Unit;

use App\Http\Controllers\MapController;
use PHPUnit\Framework\TestCase;

class GeolocationDistanceCalculator extends TestCase
{
    public function test_calculate_distance_between_two_coordinates(): void
    {
        $coor1 = [0, 0];
        //$coor2 = [10, 0];

        $mapController = new MapController();
        $distance = $mapController->calculateCoordinateDistance([$coor1[0], $coor1[1]], [$coor2[0], $coor2[1]]);

        $this->assertTrue($distance == 10);
    }
}
