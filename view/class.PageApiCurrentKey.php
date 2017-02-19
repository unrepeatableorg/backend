<?php

namespace Unrepeatable\Page;

/**
 * API endpoint which will fetch the properties of the key which is currently used
 * by the user.
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

class PageApiCurrentKey extends AbstractApiPage
{

    const PATH = "/keys/current$";

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

    private function addPaths($key)
    {
        // Prepare the SQL statement.
        $application = Application::getInstance();
        $dbHandle = $application->getDatabaseConnection();
        // Construct the paths of the keys.
        $sql = "SELECT key_id, longitude, latitude, location_name
                FROM posts
                WHERE key_id = ?
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
            $key->addPath($location);
        }
    }

    private function fetchKey($secret)
    {
        // Create a connection with the database.
        $application = Application::getInstance();
        $dbHandle = $application->connectToDatabase();
        // Prepare the SQL query.
        $sql = "SELECT * FROM `keys` WHERE secret = ?;";
        $statement = $dbHandle->prepare($sql);
        $statement->execute(array($secret));
        $key = $statement->fetchAll(PDO::FETCH_ASSOC);
        if( $key )
        {
            // Fetch the core properties of the key.
            $id = (int) $key['id'];
            $key = new Key()$name = $key['name'];
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
            // Add the paths to the key.
            $this->addPaths($key);
            // Print the JSON structure.
            print($key->toJson());
        }
        else
        {
            // Key has not been found, generate 404.
            $this->generateNotFoundResponse();
        }
    }

    /**
     * @SWG\Get(
     *     path="/api/keys/current",
     *     summary="Returns all information about the key which is currently in use by the authenticated user.",
     *     tags={"All", "Keys"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response="200",
     *         description="Returns the details of the key which is currently in use."
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Returns 404 if no key is in use at the moment."
     *     )
     * )
     */
    private function handleGetRequest()
    {
        // TODO Implement.

        // Check if the session contains the key variable.
        if( isset($_SESSION['key']) ) {
            $secret = $_SESSION['key'];
            $key = $this->fetchKey($secret);
            print($key->toJson());
        } else {
            $this->generateBadRequestResponse();
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->routeRequestMethod();
    }

    public function draw()
    {}

}