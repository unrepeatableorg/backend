<?php

namespace Unrepeatable\Page;

/**
 * API endpoint which will accept the key identifier and store it in
 * a session variable.
 *
 * @uathor  Joeri Hermans
 * @version 18 February 2017
 */

use \Carbon\Page\AbstractApiPage;

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
        // Check if the key property is specified.
        if( isset($_POST['key']) )
            // TODO Add more validation.
            $_SESSION['key'] = $_POST['key'];
        else
            $this->generateBadRequest();
    }

    public function __construct()
    {
        $this->routeRequestMethod();
    }

    public function draw()
    {}

}