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

    public function __construct()
    {
        // TODO Implement.
    }

    public function draw()
    {
        echo "POSTS enpoint called.";
    }

}