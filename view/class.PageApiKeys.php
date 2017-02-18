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
     *     path="/api/keys",
     *     summary="Returns details of keys selected by paging.",
     *     tags={"All", "Keys"},
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
     *         description="Returns the requested keys."
     *     )
     * )
     */
    private function handleGetRequest()
    {
        // TOOD Implement.
        $this->generateNotImplementedResponse();
    }

    public function __construct()
    {
        $this->routeRequestMethod();
    }

    public function draw()
    {}

}