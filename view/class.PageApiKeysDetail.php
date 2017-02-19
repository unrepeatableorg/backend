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

    private function routeRequestMethod()
    {
        $requestMethod = $this->getRequestMethod();
        switch( $requestMethod ) {
        case 'GET':
            $this->handleGetRequest();
            break;
        default:
            $this->generateNotAllowedResponse();
        }
    }

    /**
     * @SWG\Get(
     *     path="/api/keys/{keyId}",
     *     summary="Returns the details of the specified key.",
     *     tags={"All","Keys"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         in="path",
     *         name="keyId",
     *         description="Unique integer identifier of the key.",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Returns the details of the specified key."
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Returns 404 when the specified key could not be found."
     *     )
     * )
     */
    private function handleGetRequest()
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