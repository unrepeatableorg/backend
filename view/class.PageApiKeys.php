<?php

namespace Unrepeatable\Page;

/**
 * Describes all the API endpoints in the 'keys' category.
 *
 * @author  Joeri Hermans
 * @since   18 February 2017
 */

use \Carbon\Page\AbstractApiPage;

class PageApiKeys extends AbstractApiPage
{

    const PATH = "/keys$";

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

    private function handleGetRequest()
    {
        // TOOD Implement.
        $this->generateNotImplementedResponse();
    }

    public function __construct()
    {
        $this->routeRequestMethod();
    }

    public function draw()
    {
        echo "KEYS enpoint called.";
    }

}