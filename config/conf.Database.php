<?php

use \Carbon\Application\Application;

/**
 * In this configuration file you can put database related configurations which
 * are passed to the application.
 *
 * @author  Joeri Hermans
 * @version 16 February 2016
 */

// BEGIN Configuration. ////////////////////////////////////////////////////////

$conf['db_host']        = "localhost";
$conf['db_user']        = "";
$conf['db_password']    = "";
$conf['db_schema']      = "";
$conf['db_driver']      = "";

// END Configuration. //////////////////////////////////////////////////////////

// DO NOT MODIFY BELOW THIS LINE. //////////////////////////////////////////////

$application = Application::getInstance();
$application->addConfiguration($conf);
unset($conf);
