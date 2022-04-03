<?php

namespace Tests\Unit;

use App\Helpers\Math;
use App\Models\Car;
use App\Models\Game;
use App\Models\Track;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class GameTest extends MockeryTestCase
{
    public function test_game() {
        $appMock = \Mockery::mock(\App::class);

        $trackMock = \Mockery::mock(Track::class);
        $trackMock->expects('getText')->andReturn('Road')->once();


        $defenderMock = \Mockery::mock(
            Car::class,
            [
                $trackMock,
                'Lightning McQueen',
                8,
                110,
                5,
                0,
                5
            ]);
        $defenderMock->expects('run')->times(10);
        $defenderMock->expects('getName')->andReturn('Lightning McQueen')->zeroOrMoreTimes();
        $defenderMock->expects('isRunning')->times(10)->andReturn(
            true, true, true, true, true, true, true, true, true, true
        );

        $contenderMock = \Mockery::mock(
            Car::class,
            [
                $trackMock,
                'Test Car',
                5,
                190,
                8,
                0,
                7
            ]);
        $contenderMock->expects('run')->times(10);
        $contenderMock->expects('isRunning')->times(10)->andReturn(
            true, true, true, true, true, true, true, true, true, false
        );
        $contenderMock->expects('getName')->andReturn('Test Car')->zeroOrMoreTimes();
        $contendersMockArray = [$contenderMock];

        $game = new Game(
            $appMock, $trackMock, [$defenderMock, $contendersMockArray[Math::rand_int(0, count($contendersMockArray)-1)]]
        );

        $game->loop();

        $this->assertEquals($defenderMock->getName(), $game->getWinner()->getName());
    }
}
