<?php

namespace Unrepeatable\Page;

/**
 * Describes all the API endpoints in the 'keys' category.
 *
 * @author  Joeri Hermans
 * @since   18 February 2017
 */

use \Carbon\Application\Application;
use \Carbon\Page\AbstractApiPage;

use \Unrepeatable\Application\Unrepeatable;
use \Unrepeatable\Key;
use \Unrepeatable\Location;

use PDO;

class PageApiKeys extends AbstractApiPage
{

    const PATH = "/keys$";

    const DEFAULT_LAST_ID = -1;

    const DEFAULT_NUM_KEYS = 10;

    private function routeRequestMethod()
    {
        $requestMethod = $this->getRequestMethod();
        switch( $requestMethod )
        {
        case 'GET':
            $this->handleGetRequest();
            break;
        default:
            $this->generateNotAllowedResponse();
        }
    }

    private function processRaw($dbResult)
    {
        $keys = array();

        foreach( $dbResult as $key )
        {
            // Fetch core properties of the key.
            $id = (int) $key['id'];
            $name = $key['name'];
            $created = (int) $key['created'];
            $disabled = (bool) $key['disabled'];
            $distance = (double) $key['distance'];
            // Fetch first location of the key.
            $seed_lat = (double) $key['seed_latitude'];
            $seed_lon = (double) $key['seed_longitude'];
            $seed_name = $key['seed_location_name'];
            // Allocate the key and initial seed location.
            $key = new Key($id, $name, $created, $disabled, $distance);
            $location = new Location($seed_lon, $seed_lat, $seed_name);
            $key->addPath($location);
            // Add the key to the set of keys.
            $keys[$id] = $key;
        }

        return $keys;
    }

    private function display($keys)
    {
        $s;

        $numKeys = count($keys);
        if( $numKeys > 0 )
        {
            $lastId = $keys[key(end($keys))]->getId();
            reset($keys);
        }
        else
        {
            $lastId = self::DEFAULT_LAST_ID;
        }

        // Construct the JSON structure.
        $s .= '{';
        $s .= '"num_keys":' . $numKeys . ',';
        $s .= '"last_id":' . $lastId . ',';
        $s .= '"keys":[';
        for( $i = 0; $i < $numKeys; ++$i )
        {
            if( $i > 0 ) $s .= ',';
            $s .= $keys[current($keys)]->toJson();
            next($keys);
        }
        $s .= ']}';

        // Display the JSON structure.
        print($s);
    }

    /**
     * @SWG\Get(
     *     path="/api/keys",
     *     summary="Returns details of keys selected by paging.",
     *     tags={"All", "Keys"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         in="query",
     *         name="lastId",
     *         description="Last id on the previous page, by default this is 0",
     *         required=false,
     *         default=0,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         in="query",
     *         name="numEntries",
     *         description="Number of entries in the page. By default this value is set to 10, however, a 100 entries limit is enforced.",
     *         required=false,
     *         default=10,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Returns the requested keys."
     *     )
     * )
     */
    private function handleGetRequest()
    {
        // Check if in-query parameters have been specified.
        $lastId = isset($_GET['lastId']) ? (int) $_GET['lastId'] : self::DEFAULT_LAST_ID;
        $numEntries = isset($_GET['numEntries']) ? (int) $_GET['numEntries'] : self::DEFAULT_NUM_KEYS;
        // Connect with the database server.
        $application = Application::getInstance();
        $dbHandle = $application->connectToDatabase();
        // Prepare the SQL query.
        $sql = "SELECT * FROM `keys` WHERE id > ? ORDER BY id ASC LIMIT ?;";
        $statement = $dbHandle->prepare($sql);
        $statement->execute(array($lastId, $numEntries));
        // Fetch the keys from the database, and convert them to objects.
        $keys = $this->processRaw($statement->fetchAll(PDO::FETCH_ASSOC));
        $numKeys = count($keys);
        // Check if there are keys present.
        if( $numKeys > 0 )
        {
            $keyIdentifiers = "";
            // Build the key identifiers.
            for( $i = 0; $i < $numKeys; ++$i )
            {
                if( $i > 0 ) $keyIdentifiers .= ',';
                $keyIdentifiers .= $keys[$i]->getId();
            }
            // Construct the paths of the keys.
            $sql = "SELECT key_id, longitude, latitude, location_name
                    FROM posts
                    WHERE key_id IN ($keyIdentifiers)
                    ORDER BY created ASC";
            $statement = $dbHandle->prepare($sql);
            $paths = $statement->execute()->fetchAll(PDO::FETCH_ASSOC);
            foreach( $paths as $path )
            {
                $key_id = (int) $path['key_id'];
                $latitude = (double) $path['latitude'];
                $longitude = (double) $path['longitude'];
                $name = $path['location_name'];
                $location = new Location($longitude, $latitude, $name);
                $keys[$key_id]->addPath($location);
            }
        }
        // Push the results to the view.
        $this->display($keys);
    }

    public function __construct()
    {
        parent::__construct();
        $this->routeRequestMethod();
    }

    public function draw()
    {}

}