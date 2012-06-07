<?php

/*********************************************************************
 *  File:               postDataAccess.inc.php
 *  Description:        Post Data Access
 *  Author:             Nicole LaBonte
 *  Last Updated:       April 21, 2012
**********************************************************************/

/***********************************************************
 *  Includes
 ***********************************************************/
require_once('database.inc.php');
require_once('generalFunctions.inc.php');
    
/*****************************************************************
 *  Add a Post
 ******************************************************************/
function addPost($user_id, $title, $description) {

    $userIdDb = prepareDataForDatabase($user_id);
    $titleDb = prepareDataForDatabase($title);
    $descriptionDb = prepareDataForDatabase($description);

    //Query for adding a post
    $query = 'INSERT INTO posts (user_id, title, description, created)'
            ."VALUES (?,?,?, NOW())";

    $createdDate = $created;

    //Access database
    $database = new Database();
    $database->openConnection();
    $connection = $database->getDatabaseConnection();

    //Execute query
    if ($statement = $connection->prepare($query)) {
        
        $statement->bind_param('sss', $userIdDb, $titleDb, $descriptionDb);
        $statement->execute();
      
        $postId = $statement->insert_id;
        
        $statement->close();
    } 

    //close db connection
    $database->closeConnection();
    
    //return inserted post id
    return $postId;  
}

 /*****************************************************************
 *  Get Post by Post Id
 ******************************************************************/
 function getPostById($id) {
    
    $posts = array();
    
    //Query DB 
    $query = 'SELECT * FROM posts '
            ."WHERE id = ? "
            .'ORDER BY created asc, title asc';
    
    //Access database
    $database = new Database();
    $database->openConnection();
    $connection = $database->getDatabaseConnection();

    //Execute query
    if ($statement = $connection->prepare($query)) {
        $statement->bind_param('i', $id);
        $statement->execute();
        $statement->bind_result($id, $user_id, $title, $description, $created);
        
        while($statement->fetch()) {
            $posts[] = array("id" => $id,
                             "user_id" => formatForDisplay($user_id),
                             "title" => formatForDisplay($title),
                             "description" => formatForDisplay($description),
                             "created" => $created);
        }
        
        $statement->close();
    } 

    //close connection
    $database->closeConnection();
    
    //return posts
    return $posts;
    
}


/*****************************************************************
 *  Get all Posts
 ******************************************************************/
function getAllPosts() {
    
    $posts = array();
    
    //Query DB 
    $query = 'SELECT * FROM posts '
           .'ORDER BY created asc, title asc';
    
    //Access database
    $database = new Database();
    $database->openConnection();
    $connection = $database->getDatabaseConnection();

    //Execute query
    if ($statement = $connection->prepare($query)) {
        $statement->execute();
        $statement->bind_result($id, $user_id, $title, $description, $created);
        
        while($statement->fetch()) {
            $posts[] = array("id" => $id,
                             "user_id" => formatForDisplay($user_id),
                             "title" => formatForDisplay($title),
                             "description" => formatForDisplay($description),
                             "created" => $created);
        }
        
        $statement->close();
    } 

    //close connection
    $database->closeConnection();
    
    //return posts
    return $posts;
    
}

/*****************************************************************
 *  Delete a Post
 ******************************************************************/
function deletePost($id, $user_id) {
    
    $rows;
    
    //Query DB    
    $query = 'DELETE FROM posts '
           .'WHERE id = ? '
           .'AND user_id = ? ';
               
    //Access database
    $database = new Database();
    $database->openConnection();
    $connection = $database->getDatabaseConnection();

    //Execute query
    if ($statement = $connection->prepare($query)) {
        $statement->bind_param('is', $id, $user_id);
        $statement->execute();
        
        $rows = $statement->affected_rows;
        
        $statement->close();
    } 

    //close connection
    $database->closeConnection();
    
    //return success boolean
    return $rows;
}



?>