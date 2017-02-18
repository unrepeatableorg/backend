<?php

use \Carbon\Application\Application;

/**
 * Main configuration file of the application. In this file you can add
 * additional application specific configuration key-values.
 *
 * @author  Joeri Hermans
 * @since   16 February 2016
 */

// BEGIN Configuration. ////////////////////////////////////////////////////////

$conf['host']   = "unrepeatable.org";
$conf['base']   = "";

// END Configuration. //////////////////////////////////////////////////////////

// DO NOT EDIT BELOW THIS LINE. ////////////////////////////////////////////////

$application = Application::getInstance();
$application->addConfiguration($conf);
unset($conf);
