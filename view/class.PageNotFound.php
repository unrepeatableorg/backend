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

    const TITLE = "Page not found";

    public function __construct()
    {
        $this->setTitle(self::TITLE);
    }

    public function draw()
    {
        // TODO Implement.
    }

}
