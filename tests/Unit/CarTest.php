<?php

namespace Tests\Unit;

use App\Models\Car;
use App\Models\Track;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class CarTest extends MockeryTestCase {

    public function test_car_run() {
        $trackMock = \Mockery::mock(Track::class);
        $trackMock->expects('getMultiplier')->andReturn(1);
        $car = new Car(
            $trackMock,
            'Sally Carrera',
            1,
            115,
            6.5,
            0,
            8
        );
        $car->run();
        $this->assertSame(78, $car->getCurrentFuel());

    }

}