<?php

namespace App\ValueObjects;

class TrackType
{
    public const ROAD = 1;
    public const OFF_ROAD = 2;

    private array $textMap;
    private array $multiplierMap;
    private int $type;

    /**
     * TrackType constructor.
     * @param int $type
     */
    public function __construct(int $type)
    {
        $this->type = $type;
        $this->textMap = [
            1 => 'Road',
            2 => 'Off-Road'
        ];

        /*
         * since off road uses twice as much fuel the array key is the same as the actual value
         */
        $this->multiplierMap = [
            1 => 1,
            2 => 2,
        ];
    }

    /**
     * @return int|false
     */
    public function getId(): int|bool
    {
        return array_key_exists($this->type, $this->textMap)?$this->type:false;
    }

    /**
     * @return string|false
     */
    public function getText(): string|bool
    {
        return array_key_exists($this->type, $this->textMap)?$this->textMap[$this->type]:false;
    }

    /**
     * @return float|false
     */
    public function getMultiplier(): float|bool
    {
        return array_key_exists($this->type, $this->multiplierMap)?$this->multiplierMap[$this->type]:false;
    }

}