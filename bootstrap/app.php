<?php
require __DIR__.'/../vendor/autoload.php';

use App\Events\Event;
use App\Listeners\GameStartListener;
use App\Listeners\GameEndListener;
use App\Listeners\CarStatusListener;
use App\Listeners\RoundStartListener;

class App {
}

Event::registerEvents([
    'game.start' => GameStartListener::class,
    'car.status' => CarStatusListener::class,
    'round.start' => RoundStartListener::class,
    'game.end' => GameEndListener::class,
]);

return new App();