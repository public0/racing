<?php

namespace App\Listeners;

class GameStartListener extends Listener
{
    public function handle($track = null) {
        $this->output->writeln("<info>Game Started $track!</info>");
    }
}