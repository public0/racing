<?php


namespace App\Listeners;
use Symfony\Component\Console\Output\Output;


class Listener
{
    /**
     * @var Output
     */
    protected Output $output;

    /**
     * Listener constructor.
     * @param Output $output
     */
    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function handle($param = null) {
        $this->output->writeln("<info>Default listener output</info>");
    }
}