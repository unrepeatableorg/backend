<?php

namespace Unrepeatable\Page;

/**
 * API endpoint which will accept the key identifier and store it in
 * a session variable.
 *
 * @uathor  Joeri Hermans
 * @version 18 February 2017
 */

use \Carbon\Application\Application;
use \Carbon\Page\AbstractApiPage;

use \Unrepeatable\Application\Unrepeatable;

use PDO;

class PageApiUnlock extends AbstractApiPage
{

    const PATH = "/unlock$";

    private function routeRequestMethod()
    {
        $requestMethod = $this->getRequestMethod();
        switch( $requestMethod )
        {
        case 'POST':
            $this->handlePostRequest();
            break;
        default:
            $this->generateNotAllowedResponse();
        }
    }

    /**
     * @SWG\Post(
     *     path="/api/unlock",
     *     summary="Stores the key identifier in a session variable for later use.",
     *     tags={"All", "Keys"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="key",
     *         description="Unique key identifier.",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Stored the key identifier in the current session."
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Returns this HTTP error if the specified key identifier does not exists, or if the key is terminated."
     *     )
     * )
     */
    private function handlePostRequest()
    {
        $validRequest = false;

        // Check if the key property is specified.
        if( isset($_POST['key']) && strlen($_POST['key']) <= 80 )
        {
            // Fetch the key secret.
            $key = $_POST['key'];
            // Connect with the database server.
            $application = Application::getInstance();
            $dbHandle = $application->connectToDatabase();
            // Unlock the specified key, if it exists.
            $sql = 'SELECT id FROM `keys` WHERE secret = ? LIMIT 1;';
            $statement = $dbHandle->prepare($sql);
            $statement->execute(array($key));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if( count($result) == 1 )
            {
                // Add the key secret to the session.
                $_SESSION['key'] = $key;
                $validRequest = true;
            }
        }
        // Check if a valid request was presented.
        if( !$validRequest )
            $this->generateBadRequestResponse();
    }

    public function __construct()
    {
        $this->routeRequestMethod();
    }

    public function draw()
    {}

}