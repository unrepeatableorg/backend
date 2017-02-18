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

    public function __construct()
    {
        // TODO Implement.
    }

    public function draw()
    {
        echo "KEYS enpoint called.";
    }

}