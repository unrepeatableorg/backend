<?php

/**
 * A bootstrap which is responsible for loading all required files and classes
 * in order to setup the application.
 *
 * @author  Joeri Hermans
 * @since   16 February 2016
 */

// Start the session.
session_start();

// Load required functions and scripts.
require_once "core/inc.functions.php";
// Register the class autoloader function.
spl_autoload_register('loadClass');

// Add the Facebook lib.
require_once 'lib/facebook-sdk-v5/autoload.php';

use \Carbon\Application\Application;
use \Unrepeatable\Application\Unrepeatable;

$app = new Unrepeatable();
Application::setInstance($app);
parseConfiguration("Database");
parseConfiguration("Main");

use \Carbon\Router\Router;

// Allocate a router, and add initial basic pages.
$router = new Router();
$app->setRouter($router);
$router->setBase($app->getConfiguration("base"));
// Register the default "Page Not Found" page.
$router->registerPage(\Carbon\Page\PageNotFound::PATH,
                      "\Carbon\Page\PageNotFound");

// Register the application pages.
registerPages($router);
// Route the user to the desired page.
$router->route();
$view = $router->getView();
$view->draw();