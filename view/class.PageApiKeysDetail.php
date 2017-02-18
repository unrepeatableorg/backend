<?php

namespace Unrepeatable\Page;

/**
 * API endpoint which describes the details of the requested key.
 *
 * @author  Joeri Hermans
 * @version 18 February 2017
 */

use \Carbon\Page\AbstractApiPage;

class PageApiKeysDetail extends AbstractApiPage
{

    const PATH = "/keys/[0-9]+$";

    private function routeRequestMethod()
    {
        $requestMethod = $this->getRequestMethod();
        switch( $requestMethod ) {
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
    {
        echo "Calling key detail endpoint.";
    }

}