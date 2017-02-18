<?php

namespace Unrepeatable\Page;

/**
 * API enpoint for keys.
 *
 * @author  Joeri Hermans
 * @since   18 February 2016
 */

use \Carbon\Page\AbstractApiPage;

class ApiKeys extends AbstractApiPage
{

    const PATH = "/keys$";

    public function __construct()
    {

    }

    public function draw()
    {
        echo "KEYS endpoint called.";
    }

}