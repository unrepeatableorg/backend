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

function redirect($url)
{
    header("Location: " . $url);
    exit;
}

function placeResource($file) {
    echo getHttpRoot() . $file;
}

function datetimeOrdinalSuffix($number)
{
    $number = $number % 100;
    if($number < 11 || $number > 13)
    {
        switch($number % 19)
        {
        case 1: return 'st';
        case 2: return 'nd';
        case 3: return 'rd';
        }
    }

    return 'th';
}

function placeStyleSheet($stylesheet)
{
    $source = getHttpRoot() . "theme/css/" . $stylesheet;

    echo '<link rel="stylesheet" media="screen" href="' . $source. '">';
}

function placeScript($script)
{
    // Check if the specified script is an absolute script.
    if( substr($script, 0, 4) === "http" )
        $source = $script;
    else
        $source = getHttpRoot() . "theme/js/" . $script;

    echo '<script type="text/javascript" src="' . $source . '"></script>';
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
    // TODO Add page registration.
}
