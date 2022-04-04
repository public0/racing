<?php

namespace App\Events;
use Symfony\Component\Console\Output\ConsoleOutput;

class Event {
    public static array $events = [];

    /**
     * @param $name
     * @param $argument
     * @TODO This can be improved by not being static and and using a singleton instead of new ConsoleOutput
     */
    public static function trigger($name, $argument = null) {
        if(isset(self::$events[$name])) {
            foreach (self::$events[$name] as $event => $callback) {
                $instance = new $callback(new ConsoleOutput());
                if($argument && is_array($argument)) {
                    call_user_func_array([$instance, 'handle'], $argument);
                }
                elseif ($argument && !is_array($argument)) {
                    call_user_func([$instance, 'handle'], $argument);
                }
                else {
                    call_user_func([$instance, 'handle']);
                }
            }
        }
    }

    /**
     * @param string $name
     * @param string $callback
     * @return void
     */
    public static function registerEvent(string $name, string $callback): void
    {
        self::$events[$name][] = $callback;
    }

    /**
     * @param array $events
     */
    public static function registerEvents(array $events): void
    {
        foreach ($events as $event => $listener) {
            self::registerEvent($event, $listener);
        }
    }

}