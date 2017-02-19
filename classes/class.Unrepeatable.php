<?php

namespace Unrepeatable\Application;

/**
 * Class which describes the properties of the Unrepeatable.org
 * backend application.
 *
 * @author  Joeri Hermans
 * @since   18 February 2017
 */

use \Carbon\Application\DatabaseApplication;

class Unrepeatable extends DatabaseApplication
{

    const FB_SECRET = "fb_secret";

    const FB_APP_ID = "fb_app_id";

    public function __construct()
    {
        // TODO Implement logic here.
    }

    public function getFacebookSecret()
    {
        return $this->getConfiguration(Unrepeatable::FB_SECRET);
    }

    public function getFacebookAppId()
    {
        return $this->getConfiguration(Unrepeatable::FB_APP_ID);
    }

}