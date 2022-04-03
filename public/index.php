<?php
$app = require __DIR__.'/../bootstrap/app.php';

use App\Models\Car;
use App\Models\Game;
use App\Models\Track;
use App\Helpers\Math;
use App\ValueObjects\TrackType;

//$tracksTypesArray = [TrackType::ROAD, TrackType::OFF_ROAD];
//$track = new Track($tracksTypesArray[Math::rand_int(0, count($tracksTypesArray)-1)]);

$tracksTypesArray = [new TrackType(TrackType::ROAD), new TrackType(TrackType::OFF_ROAD)];
$track = new Track($tracksTypesArray[Math::rand_int(0, count($tracksTypesArray)-1)]);

$defender = new Car(
    $track,
    'Lightning McQueen',
    Math::rand_float(8, 9),
    Math::rand_int(110, 190),
    Math::rand_float(5, 7),
    0,
    5
);

$contenders = [
    new Car(
        $track,
        'Doc Hudson',
        Math::rand_float(8, 9),
        Math::rand_int(90, 120),
        Math::rand_float(4, 6),
        0,
        7
    ),
    new Car(
        $track,
        'Snotrod',
        Math::rand_float(4, 6),
        Math::rand_int(190, 250),
        Math::rand_float(4.5, 7),
        0,
        9
    ),
    new Car(
        $track,
        'Sarge',
        Math::rand_float(7.5, 8.5),
        Math::rand_int(130, 200),
        Math::rand_float(6, 7.5),
        1,
        10
    ),
    new Car(
        $track,
        'Sally Carrera',
        Math::rand_float(1, 2.5),
        Math::rand_int(115, 150),
        Math::rand_float(6.5, 8.5),
        0,
        8
    ),

];

$game = new Game(
    $app, $track, [$defender, $contenders[Math::rand_int(0, count($contenders)-1)]]
);
$game->loop();