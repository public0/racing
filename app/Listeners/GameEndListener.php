<?php

namespace App\Listeners;

class GameEndListener extends Listener
{
    public function handle($car = null) {

        $this->output->writeln("");
        $this->output->write("<info>Game over. Winner is: </info>");
        $this->output->writeln("<fg=blue;options=bold;>".$car->getName()."!!!</>");
    }

}