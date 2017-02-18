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

    private function handleGetRequest()
    {
        // TODO Implement.
        $this->generateNotImplementedResponse();
    }

    public function __construct()
    {
        $this->routeRequestMethod();
    }

    public function draw()
    {}

}