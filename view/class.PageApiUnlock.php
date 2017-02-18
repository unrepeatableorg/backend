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
        // Check if the key property is specified.
        if( isset($_POST['key']) )
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