<?php

namespace Carbon\Application;

/**
 * An abstract class which holds database functionality and storage.
 *
 * @author  Joeri Hermans
 * @since   25 October 2016
 */

use \Carbon\Application\Application;

use PDO;

abstract class DatabaseApplication extends Application
{

    const CONF_DB_HOST = "db_host";
    const CONF_DB_USERNAME = "db_user";
    const CONF_DB_PASSWORD = "db_password";
    const CONF_DB_DRIVER = "db_driver";
    const CONF_DB_SCHEMA = "db_schema";

    private $mDatabaseHandle = null;

    public function __destruct()
    {
        $this->disconnectFromDatabase();
    }

    public function connectToDatabase()
    {
        // Check if a database handle is already available.
        if( $this->mDatabaseHandle == null ) {
            // Fetch all required information.
            $dbhost = $this->getConfiguration(self::CONF_DB_HOST);
            $dbuser = $this->getConfiguration(self::CONF_DB_USERNAME);
            $dbpass = $this->getConfiguration(self::CONF_DB_PASSWORD);
            $dbdriver = $this->getConfiguration(self::CONF_DB_DRIVER);
            $dbschema = $this->getConfiguration(self::CONF_DB_SCHEMA);
            // Construct the connection string for PDO.
            $connectionString = $dbdriver . ":host=" . $dbhost .
                              ";dbname=" . $dbschema;
            // Connect to the database.
            $this->mDatabaseHandle = new PDO($connectionString, $dbuser, $dbpass);
        }

        return $this->mDatabaseHandle;
    }

    public function disconnectFromDatabase()
    {
        unset($this->mDatabaseHandle);
        $this->mDatabaseHandle = null;
    }

    public function getDatabaseConnection()
    {
        return $this->mDatabaseHandle;
    }

    public function isConnectedToDatabase()
    {
        return $this->mDatabaseHandle != null;
    }

}