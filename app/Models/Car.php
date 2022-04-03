<?php

namespace App\Models;

class Car {
    private string $name;
    private float $xp;
    private int   $power;
    private float $tires;
    private bool  $offRoad;
    private int   $fuelPerRound;

    private float $currentFuel;
    private bool $status;

    private Track $track;

    /**
     * Car constructor.
     * @param Track $track
     * @param string $name
     * @param float $xp
     * @param int $power
     * @param float $tires
     * @param bool $offRoad
     * @param int $fuelPerRound
     */
    public function __construct(
        Track $track,
        string $name,
        float  $xp,
        int    $power,
        float  $tires,
        bool   $offRoad,
        int    $fuelPerRound
    )
    {
        $this->name = $name;
        $this->xp = $xp;
        $this->power = $power;
        $this->tires = $tires;
        $this->offRoad = $offRoad;
        $this->fuelPerRound = $fuelPerRound;
        $this->track = $track;
        $this->currentFuel = 100;
        $this->status = true;
    }

    public function setCurrentFuel($amount) {
        $this->currentFuel = $amount;
    }

    public function getCurrentFuel():int {
        return ($this->currentFuel < 0)?0:$this->currentFuel;
    }

    public function run() {
        /*
         * @TODO formula probably could use improvements
         *
         * this formula relies on a 1 to 1 relation between horse power and fuel consumption,
         * for example a 160 horse power car uses 1.6 gas and a 100 horse power car uses 1.0
         */
        $this->currentFuel = $this->currentFuel -
                (
                    $this->track->getMultiplier() *
                    $this->fuelPerRound * // 1 to 1 ratio with consumption the more power the more fuel it uses
                    ($this->power) *
                    ($this->tires/50) * // 1 to 1 ratio with consumption  the bigger the tires the more fuel it uses
                    ((10-$this->xp)/50) // inverse of 1 to 1 the more xp the less fuel it uses
                );

        if($this->getCurrentFuel() <= 1) {
            $this->status = false;
        }
    }

    /**
     * @return float
     */
    public function getXp(): float
    {
        return $this->xp;
    }

    /**
     * @param float $xp
     */
    public function setXp(float $xp): void
    {
        $this->xp = $xp;
    }

    /**
     * @return int
     */
    public function getPower(): int
    {
        return $this->power;
    }

    /**
     * @param int $power
     */
    public function setPower(int $power): void
    {
        $this->power = $power;
    }

    /**
     * @return float
     */
    public function getTires(): float
    {
        return $this->tires;
    }

    /**
     * @param float $tires
     */
    public function setTires(float $tires): void
    {
        $this->tires = $tires;
    }

    /**
     * @return bool
     */
    public function isOffRoad(): bool
    {
        return $this->offRoad;
    }

    /**
     * @param bool $offRoad
     */
    public function setOffRoad(bool $offRoad): void
    {
        $this->offRoad = $offRoad;
    }

    /**
     * @return int
     */
    public function getFuelPerRound(): int
    {
        return $this->fuelPerRound;
    }

    /**
     * @param int $fuelPerRound
     */
    public function setFuelPerRound(int $fuelPerRound): void
    {
        $this->fuelPerRound = $fuelPerRound;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isRunning(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

}