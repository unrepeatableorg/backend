<?php

namespace Unrepeatable;

/**
 * Describes the properties and actions of a key.
 *
 * @author  Joeri Hermans
 * @since   19 February 2017
 */

use \Unrepeatable\Location;

class Key
{

    /**
     * Contains the unique key identifier of the key.
     */
    private $mId;

    /**
     * Contains the unique name of the key.
     */
    private $mName;

    /**
     * Timestamp of key creation time.
     */
    private $mCreatedTimestamp;

    /**
     * Flag which indicates if the key has been disabled.
     */
    private $mDisabled;

    /**
     * Total distance the key has travelled.
     */
    private $mDistance;

    /**
     * Contains the path of locations the key has travelled through.
     */
    private $mPath;

    /**
     * Holds the length of the path.
     */
    private $mPathLength;

    public function __construct($id, $name, $created, $disabled, $distance, $path = array())
    {
        $this->mId = $id;
        $this->mName = $name;
        $this->mCreatedTimestamp = $created;
        $this->mDisabled = $disabled;
        $this->mPath = $path;
        $this->mDistance = $distance;
        $this->mPathLength = count($path);
    }

    public function getId()
    {
        return $this->mId;
    }

    public function getName()
    {
        return $this->mName;
    }

    public function getCreationTimestamp()
    {
        return $this->mCreatedTimestamp;
    }

    public function isDisabled()
    {
        return $this->mDisabled;
    }

    public function getDistance()
    {
        return $this->mDistance;
    }

    public function getPath()
    {
        return $this->mPath;
    }

    public function addPath($location)
    {
        $this->mPath[] = $location;
        ++$this->mPathLength;
    }

    public function getPathLength()
    {
        return $this->mPathLength;
    }

    public function getSeedLocation()
    {
        return $this->mPath[0];
    }

    public function getLastLocation()
    {
        return $this->mPath[$this->mPathLength - 1];
    }

    /**
     * Example structure:
     * {
     *     "id": 0,
     *      "name": "alpha",
     *      "disabled": false,
     *      "created": 24893429,
     *      "distance": 323.434
     *      "path": [
     *      {
     *        "latitude": 23.4343443,
     *        "longitude": 23.434343,
     *        "name": "CERN"
     *      },
     *      {
     *        "latitude": 23.4343443,
     *        "longitude": 23.434343,
     *        "name": "Lanaken, Belgium"
     *      }
     *      ]
     *  }
     */
    public function toJson()
    {
        $s;

        // Check if the key is disabled.
        if( $this->mDisabled )
            $disabled = "true";
        else
            $disabled = "false";
        // Fetch the number of paths.
        $pathLength = $this->mPathLength;

        $s. = '{';
        $s .= '"id":' . $this->mId . ',';
        $s .= '"name":"' . $this->mName . '",';
        $s .= '"disabled":' . $disabled . ',';
        $s .= '"created":' . $this->mCreatedTimestamp . ',';
        $s .= '"distance":' . $this->mDistance . ',';
        $s .= '"path":[';
        for( $i = 0; $i < $pathLength; ++$i )
        {
            // Don't append a comma at the start.
            if( $i > 0 )
                $.= ',';
            // Append the location object.
            $s .= $this->mPath[$i]->toJson();
        }
        $s. = ']}';

        return $s;
    }

}