<?php

namespace Carbon\Page;

/**
 * Describes the properties and actions of an abstract API page.
 *
 * @author  Joeri Hermans
 * @since   26 June 2016
 */

use \Carbon\Page\AbstractPage;

abstract class AbstractApiPage extends AbstractPage {

    protected function generateError($httpCode)
    {
        http_response_code($httpCode);
        exit;
    }

    protected function generateResponseCode($httpCode)
    {
        http_response_code($httpCode);
        exit;
    }

    protected function generateNotImplementedResponse()
    {
        http_response_code(501);
        exit;
    }

    protected function generateNotAllowedResponse()
    {
        http_response_code(405);
        exit;
    }

    protected function generateFailureResponse()
    {
        http_response_code(409);
        exit;
    }

    protected function generateNotFoundResponse()
    {
        http_response_code(404);
        exit;
    }

    protected function generateForbiddenResponse()
    {
        http_response_code(403);
        exit;
    }

    protected function generateBadRequestResponse()
    {
        http_response_code(400);
        exit;
    }

    protected function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function isHttpGet()
    {
        return $this->getRequestMethod() == "GET";
    }

    protected function isHttpPost()
    {
        return $this->getRequestMethod() == "POST";
    }

    protected function isHttpUpdate()
    {
        return $this->getRequestMethod() == "DELETE";
    }

    protected function isHttpPut()
    {
        return $this->getRequestMethod() == "PUT";
    }

    protected function encodeJSON($encodeData, $options = null)
    {
        return json_encode($encodeData, $options);
    }

    protected function decodeJSON($decodeData, $options = null)
    {
        return json_decode($decodeData, $options);
    }

    public function __construct()
    {
        header('Content-Type: application/json');
    }

}