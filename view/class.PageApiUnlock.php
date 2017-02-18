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

    private function handlePostRequest()
    {
        // TODO Implement.
        $this->generateNotImplementedResponse();
    }

    public function __construct()
    {
        $this->routeRequestMethod();
    }

    public function draw()
    {
        echo "UNLOCK endpoint called.";
    }

}