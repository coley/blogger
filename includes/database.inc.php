<?php

/*********************************************************************
 *  File:               database.inc.php
 *  Description:        Database Configuration class
 *  Author:             Nicole LaBonte
 *  Last Updated:       March 31, 2012
**********************************************************************/

/***********************************************************
 *  Includes
 ***********************************************************/
require_once('config.inc.php');

/***********************************************************
 *  Class definition
 ***********************************************************/
class Database {

 /*****************************************************************
     *  Instance variables
 ******************************************************************/
 private $host;
 private $databaseName;
 private $databaseUsername;
 private $databasePassword;
 private $databaseLink;
 private $databaseConnection;

 /*****************************************************************
  *  Database constructor
 ******************************************************************/
    public function __construct() {
                
        $this->host = HOST_NAME;
        $this->databaseName = DATABASE_NAME;
        $this->databaseUsername = DB_USERNAME;
        $this->databasePassword = DB_PASSWORD;
        $this->databaseSourceName = "mysql:dbname={$DATABASE_NAME};host={$HOST_NAME}";
    }
    
 /*****************************************************************
  *  Database get functions
 ******************************************************************/
    public function getDatabaseConnection() {
        return $this->databaseConnection;
    }

   public function getDatabaseLink() {
        return $this->databaseLink;
    }


 /*****************************************************************
  *  Database open connection
 ******************************************************************/
 function openConnection() {
    
    @ $this->databaseConnection = new mysqli($this->host,
                                             $this->databaseUsername, 
                                             $this->databasePassword,
                                             $this->databaseName);

   //Check if connection occurred
   if (mysqli_connect_errno()) {
      exit('Error 100: Connection failure. Please contact System Administrator.');
   }

   $this->databaseLink = mysqli_connect($this->host,
                                        $this->databaseUsername,
                                        $this->databasePassword)
         or die(mysqli_error());
 }
 
 /*****************************************************************
  *  Database close connection
 ******************************************************************/
 function closeConnection() {
    
    $this->databaseConnection->close();
 }
    
}
