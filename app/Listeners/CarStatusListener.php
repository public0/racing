<?php

namespace App\Listeners;

class CarStatusListener extends Listener
{
    public function handle($car = NULL) {
        $this->output->write("<fg=blue;options=bold;>".$car->getName().', '."</>");
        $this->output->writeln("<info>".$car->getCurrentFuel()." fuel left."."</info>");
    }

}