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

    public function __construct()
    {
        // TODO Impelment.
    }

    public function draw()
    {
        echo "Calling key detail endpoint.";
    }

}