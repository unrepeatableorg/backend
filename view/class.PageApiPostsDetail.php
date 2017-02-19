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

    private function routeRequestMethod()
    {
        $requestMethod = $this->getRequestMethod();
        switch( $requestMethod )
        {
        case 'GET':
            $this->handleGetRequest();
            break;
        default:
            $this->generateNotAllowedResponse();
        }
    }

    /**
     * @SWG\Get(
     *     path="/api/posts/{postId}",
     *     summary="Returns the details of a specific post.",
     *     tags={"All", "Posts"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         in="path",
     *         name="postId",
     *         description="Unique integer identifier of the post.",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="The details of the post are returned."
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="The specified post-id could not be retrieved."
     *     )
     * )
     */
    private function handleGetRequest()
    {
        $this->generateNotImplementedResponse();
    }

    public function __construct()
    {
        parent::__construct();
        $this->routeRequestMethod();
    }

    public function draw()
    {}

}