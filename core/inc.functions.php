<?php

/**
 * A collection of application wide utility functions.
 *
 * @author  Joeri Hermans
 * @since   16 February 2016
 */

use \Carbon\Application\Application;

function loadClass($className)
{
    $clearedFromNamespace = strrchr($className, '\\');
    if( $clearedFromNamespace != null )
        $className = substr($clearedFromNamespace, 1);
    $path = "classes/class." . $className . ".php";
    if( !file_exists($path) ) {
        $path = "view/class." . $className . ".php";
        if( !file_exists($path) ) {
            $path = "core/application/class." . $className . ".php";
        }
    }

    require_once $path;
}

function parseConfiguration($config)
{
    require_once "config/conf." . $config . ".php";
}

function validEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function getProtocol()
{
    $protocol;

    if( isset($_SERVER['HTTPS']) )
        $protocol = "https://";
    else
        $protocol = "http://";

    return $protocol;
}

function getHost()
{
    return Application::getInstance()->getHost();
}

function getBase()
{
    return Application::getInstance()->getBase();
}

function redirectInternally($uri)
{
    $app = Application::getInstance();
    $protocol = getProtocol();
    $host = $app->getHost();
    $base = $app->getBase();
    redirect($protocol . $host . $base . $uri);
}

function placeResource($file) {
    echo getHttpRoot() . $file;
}

function getHttpRoot()
{
    $app = Application::getInstance();
    $protocol = getProtocol();
    $host = $app->getHost();
    $base = $app->getBase();

    return $protocol . $host . $base . "/";
}

function placeURI($uri)
{
    echo getHttpRoot() . $uri;
}

function placeHttpRoot()
{
    echo getHttpRoot();
}

function registerPages($router)
{
    // Register "posts" enpoints.
    $router->registerPage(\Unrepeatable\Page\PageApiPosts::PATH,
                          "\Unrepeatable\Page\PageApiPosts");
    $router->registerPage(\Unrepeatable\Page\PageApiPostsDetail::PATH,
                          "\Unrepeatable\Page\PageApiPostsDetail");
    // Register "keys" enpoints.
    $router->registerPage(\Unrepeatable\Page\PageApiKeys::PATH,
                          "\Unrepeatable\Page\PageApiKeys");
    $router->registerPage(\Unrepeatable\Page\PageApiKeysDetail::PATH,
                          "\Unrepeatable\Page\PageApiKeysDetail");
    // Register "unlock" endpoint.
    $router->registerPage(\Unrepeatable\Page\PageApiUnlock::PATH,
                          "\Unrepeatable\Page\PageApiUnlock");
}
