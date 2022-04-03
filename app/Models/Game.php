<?php

namespace App\Models;

use App;
use App\Events\Event;

class Game {
    private bool $status;
    private array $cars;
    private Track $track;
    private Car $loser;
    private Car $winner;
    private int $roundCount;
    private App $app;

    /**
     * Game constructor.
     * @param App $app
     * @param Track $track
     * @param $cars Car[]
     */
    public function __construct(
        App $app,
        Track $track,
        array $cars
    )
    {
        $this->status = true;
        $this->cars = $cars;
        $this->app = $app;
        $this->track = $track;
        $this->roundCount = 1;
    }

    /**
     * @return Car
     */
    public function getTrack(): Track
    {
        return $this->track;
    }

    /**
     * @return Car
     */
    public function getLoser(): Car
    {
        return $this->loser;
    }

    /**
     * @return Car|null
     */
    public function getWinner(): ?Car
    {
        return $this->winner;
    }

    /**
     * Game loop
     * @return void
     */
    public function loop(): void {
        Event::trigger('game.start', $this->getTrack()->getText());
        while($this->status) {
            Event::trigger('round.start', $this->roundCount);
            foreach ($this->cars as $id => $car) {
                $car->run();
                Event::trigger('car.status', $car);
                /*
                 * Ideally this would be calculated in threads each car having it's own thread not in a car loop
                 * here basically we're saying the car that we didn't find as having stopped won
                 * so the first car in array would have a disadvantage since we're checking it first
                 */
                if(!$car->isRunning()) {
                    $this->status = false;
                    $this->loser = $car;
                    /*
                     * count($this->cars) - $id - 1 -> this basically means the other car in the array won,
                     * only viable in this 2 max cars race situation
                    */
                    $this->winner = $this->cars[count($this->cars) - $id - 1];
                }
            }
            if(!$this->status) {
                Event::trigger('game.end', $this->getWinner());
                break;
            }
            ++$this->roundCount;
        }
    }

}