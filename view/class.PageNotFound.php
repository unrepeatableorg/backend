<?php

namespace Carbon\Page;

/**
 * A class which represents the properties and actions of the
 * page not found page.
 *
 * @author  Joeri Hermans
 * @since   17 February 2016
 */

use \Carbon\Page\AbstractPage;

class PageNotFound extends AbstractPage
{

    const PATH = "/404$";

    public function __construct()
    {
        header('HTTP/1.0 404 Not Found');
    }

    public function draw()
    {}

}
