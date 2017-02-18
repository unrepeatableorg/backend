<?php

namespace Carbon\Application;

/**
 * A class which describes the properties and actions of an Application. In this
 * abstraction the main properties and configuration will be described. In the
 * case more detailed functionality is required (e.g., PDO database), a subclass
 * will have to be implemented.
 *
 * @author  Joeri Hermans
 * @since   16 February 2016
 */

abstract class Application
{

    /**
     * Reference to the singleton instance of the Application.
     */
    private static $mInstance;

    /**
     * Contains the main configuration of the application in a key-value
     * manner.
     */
    private $mConfiguration;

    /**
     * Holds the page router.
     */

    public function clearConfiguration()
    {
        unset($this->mConfiguration);
        $this->mConfiguration = null;
    }

    public function addConfiguration($configuration)
    {
        foreach($configuration as $k => $v)
            $this->mConfiguration[$k] = $v;
    }

    public function putConfiguration($key, $value)
    {
        $this->mConfiguration[$key] = $value;
    }

    public function getConfiguration($key)
    {
        $value = null;

        if( isset($this->mConfiguration[$key]) )
            $value = $this->mConfiguration[$key];

        return $value;
    }

    public function removeConfiguration($key)
    {
        if( isset($this->mConfiguration[$key]) )
            unset($this->mConfiguration[$key]);
    }

    public function getBase()
    {
        return $this->getConfiguration("base");
    }

    public function getHost()
    {
        return $this->getConfiguration("host");
    }

    public function setRouter($router)
    {
        $this->mRouter = $router;
    }

    public function getRouter()
    {
        return $this->mRouter;
    }

    public static function getInstance()
    {
        if( static::$mInstance === null ) {
            $calledClass = get_called_class();
            static::$mInstance = new $calledClass();
        }

        return static::$mInstance;
    }

    public static function setInstance($application)
    {
        if( $application instanceof Application )
            static::$mInstance = $application;
    }

}
