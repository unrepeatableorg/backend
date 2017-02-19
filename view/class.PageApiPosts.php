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

    /**
     * @SWG\Get(
     *     path="/api/posts",
     *     summary="Returns details of posts selected by paging.",
     *     tags={"All", "Posts"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         in="query",
     *         name="lastId",
     *         description="Last id on the previous page, by default this is 0",
     *         required=false,
     *         default=0,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         in="query",
     *         name="numEntries",
     *         description="Number of entries in the page. By default this value is set to 10, however, a 100 entries limit is enforced.",
     *         required=false,
     *         default=10,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Returns the requested posts."
     *     )
     * )
     */
    private function handleGetRequest()
    {
        // TODO Implement.

        $this->generateNotImplementedResponse();
    }

    /**
     * TODO Implement, unknown API at the moment.
     *
     * @SWG\Post(
     *    path="/api/posts",
     *    summary="Add a posts with the specified details.",
     *    tags={"All", "Posts"},
     *    @SWG\Response(
     *        response="200",
     *        description="The post has been succesfully created."
     *    ),
     *    @SWG\Response(
     *        response="409",
     *        description="Could not create the post with the specified details."
     *    )
     * )
     */
    private function handlePostRequest()
    {
        // TODO Implement.

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