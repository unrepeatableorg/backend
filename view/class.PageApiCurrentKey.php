<?php

namespace Unrepeatable\Page;

/**
 * API endpoint which will fetch the properties of the key which is currently used
 * by the user.
 *
 * @author  Joeri Hermans
 * @since   18 February 2017
 */

use \Carbon\Page\AbstractApiPage;

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
            $this->generateNotFoundResponse();
        } else {
            $this->generateNotImplementedResponse();
        }
    }

    public function __construct()
    {
        $this->routeRequestMethod();
    }

    public function draw()
    {}

}