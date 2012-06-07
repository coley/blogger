<?php

/*********************************************************************
 *  File:               userDataAccess.inc.php
 *  Description:        User Data Access class
 *  Author:             Nicole LaBonte
 *  Last Updated:       April 21, 2012
**********************************************************************/

/***********************************************************
 *  Includes
 ***********************************************************/
require_once('database.inc.php');
require_once('generalFunctions.inc.php');
    
/*****************************************************************
 *  Find id
 ******************************************************************/
function findId($user_id, $password) {
    
    $id = 0;
    $userIdDb = prepareDataForDatabase($user_id);
    $passwordDb = prepareDataForDatabase($password);

    //Query DB for logged in user
    $query = 'SELECT id FROM users '
           ."WHERE user_id = ? "
           ."AND password = sha1(?) ";
    
    //Access database
    $database = new Database();
    $database->openConnection();
    $connection = $database->getDatabaseConnection();

    //Execute query
    if ($statement = $connection->prepare($query)) {
        $statement->bind_param('ss', $userIdDb, $passwordDb);
        $statement->execute();
        $statement->bind_result($id);
        $statement->fetch();
        
        $statement->close();
    } 

    //close connection
    $database->closeConnection();
    
    //return id
    return $id;
    
}

/*****************************************************************
 *  Find username
 ******************************************************************/
function findUserId($id) {
    
    $user_id;

    //Query DB for logged in user
    $query = 'SELECT user_id FROM users '
           ."WHERE id = ? ";
    
    //Access database
    $database = new Database();
    $database->openConnection();
    $connection = $database->getDatabaseConnection();

    //Execute query
    if ($statement = $connection->prepare($query)) {
        $statement->bind_param('i', $id);
        $statement->execute();
        $statement->bind_result($user_id);
        $statement->fetch();
        
        $statement->close();
    } 

    //close connection
    $database->closeConnection();
    
    //return username
    return $user_id;   
}
?>