<?php

namespace Unrepeatable\Page;

/**
 * Describes all the API endpoints in the 'posts' category.
 *
 * @author  Joeri Hermans
 * @since   18 February 2017
 */

use \Carbon\Page\AbstractApiPage;

class PageApiPosts extends AbstractApiPage
{

    const PATH = "/posts$";

    private function routeRequestMethod()
    {
        $requestMethod = $this->getRequestMethod();
        switch( $requestMethod )
        {
        case 'GET':
            $this->handleGetRequest();
            break;
        case 'POST':
            $this->handlePostRequest();
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

    private function handlePostRequest()
    {
        // TODO Impelement.
        $this->generateNotImplementedResponse();
    }

    public function __construct()
    {
        $this->routeRequestMethod();
    }

    public function draw()
    {
        echo "POSTS enpoint called.";
    }

}