<?php

namespace App\Models;
use  App\ValueObjects\TrackType;

class Track {

    /**
     * @var TrackType
     */
    private TrackType $type;

    /**
     * Track constructor.
     * @param TrackType $type
     */
    public function __construct(TrackType $type )
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getId() : int {
        /*
         * in this case TrackType id same as Track id since we have no persistence layer
         */
        return $this->type->getId();
    }

    /**
     * @return string
     */
    public function getText() : string {
        /*
         * in this case TrackType id same as Track id since we have no persistence layer
         */
        return $this->type->getText();
    }

    /**
     * @return float
     */
    public function getMultiplier() : float {
        return $this->type->getMultiplier();
    }
}