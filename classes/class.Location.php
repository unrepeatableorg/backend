<?php

namespace Unrepeatable;

/**
 * A class which describes the properties of a location.
 *
 * @author  Joeri Hermans
 * @version 19 February 2017
 */

class Location
{

    /**
     * Longitude of the location expressed as a double.
     */
    private $mLongitutde = 0;

    /**
     * Latitude of the location expressed as a double.
     */
    private $mLatitude = 0;

    /**
     * String representation of the location, can be a name.
     */
    private $mName;

    public function __construct($longitude, $latitude, $name="")
    {
        $this->mLongitude = $longitude;
        $this->mLatitude = $latitude;
        $this->mName = $name;
    }

    public function getLongitude()
    {
        return $this->mLongitude;
    }

    public function getLatitude()
    {
        return $this->mLatitude;
    }

    public function getName()
    {
        return $this->mName;
    }

    public function hasName()
    {
        return $this->mName;
    }

    public function toJson()
    {
        $s;

        $s .= '{';
        $s .= '"longitude":' . $this->mLongitude . ',';
        $s .= '"latitude":' . $this->mLatitude . ',';
        $s .= '"name":' . $this->mName;
        $s .= '}';

        return $s;
}