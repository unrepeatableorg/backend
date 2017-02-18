<?php

namespace Unrepeatable\Page;

/**
 * API endpoint which describes the details of the requested key.
 *
 * @author  Joeri Hermans
 * @version 18 February 2017
 */

use \Carbon\Page\AbstractApiPage;

class PageApiPostsDetail extends AbstractApiPage
{

    const PATH = "/posts/[0-9]+$";

    public function __construct()
    {
        // TODO Implement.
    }

    public function draw()
    {
        echo "Calling posts detail endpoint.";
    }

}