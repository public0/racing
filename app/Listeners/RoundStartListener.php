<?php

namespace App\Listeners;

class RoundStartListener extends Listener
{
    public function handle($round = null) {
        $this->output->writeln("<fg=red>Round ".$round."!</>");
    }

}