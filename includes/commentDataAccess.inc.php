<?php

/*********************************************************************
 *  File:               commentDataAccess.inc.php
 *  Description:        Comment Data Access
 *  Author:             Nicole LaBonte
 *  Last Updated:       April 22, 2012
**********************************************************************/

 /***********************************************************
 *  Includes
 ***********************************************************/
 require_once('database.inc.php');
 require_once('generalFunctions.inc.php');
    
 /*****************************************************************
 *  Add a Comment
 ******************************************************************/
 function addComment($user_id, $post_id, $description) {

    $userIdDb = prepareDataForDatabase($user_id);
    $descriptionDb = prepareDataForDatabase($description);

    //Query for adding a post
    $query = 'INSERT INTO comments (user_id, post_id, description, created)'
            ."VALUES (?,?,?, NOW())";

    $createdDate = $created;

    //Access database
    $database = new Database();
    $database->openConnection();
    $connection = $database->getDatabaseConnection();

    //Execute query
    if ($statement = $connection->prepare($query)) {
        
        $statement->bind_param('sis', $userIdDb, $post_id, $descriptionDb);
        $statement->execute();
      
        $commentId = $statement->insert_id;
        
        $statement->close();
    } 

    //close db connection
    $database->closeConnection();
    
    //return inserted post id
    return $commentId;  
 }

 /*****************************************************************
 *  Get All comments by post Id
 ******************************************************************/
 function getCommentByPostId($post_id) {
    
    $comments = array();
    
    //Query DB 
    $query = 'SELECT * FROM comments '
            ."WHERE post_id = ? "
            .'ORDER BY created asc';
    
    //Access database
    $database = new Database();
    $database->openConnection();
    $connection = $database->getDatabaseConnection();

    //Execute query
    if ($statement = $connection->prepare($query)) {
        $statement->bind_param('i', $post_id);
        $statement->execute();
        $statement->bind_result($id, $user_id, $post_id, $description, $created);
        
        while($statement->fetch()) {
            $comments[] = array("id" => $id,
                                "user_id" => formatForDisplay($user_id),
                                "post_id" => $post_id,
                                "description" => formatForDisplay($description),
                                "created" => $created);
        }
        
        $statement->close();
    } 

    //close connection
    $database->closeConnection();
    
    //return comments
    return $comments;
    
 }
 
  /*****************************************************************
 *  Get comment by comment id
 ******************************************************************/
 function getCommentByCommentId($comment_id) {
    
    $comments = array();
    
    //Query DB 
    $query = 'SELECT * FROM comments '
            ."WHERE id = ? "
            .'ORDER BY created asc';
    
    //Access database
    $database = new Database();
    $database->openConnection();
    $connection = $database->getDatabaseConnection();

    //Execute query
    if ($statement = $connection->prepare($query)) {
        $statement->bind_param('i', $comment_id);
        $statement->execute();
        $statement->bind_result($id, $user_id, $post_id, $description, $created);
        
        while($statement->fetch()) {
            $comments[] = array("id" => $id,
                                "user_id" => formatForDisplay($user_id),
                                "post_id" => $post_id,
                                "description" => formatForDisplay($description),
                                "created" => $created);
        }
        
        $statement->close();
    } 

    //close connection
    $database->closeConnection();
    
    //return comments
    return $comments;
    
 }


?>