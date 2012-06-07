<?php

 /***********************************************************
 * Includes
 ***********************************************************/
 require_once('../includes/services.inc.php');

 /***********************************************************
 * Return json of all comments for given post id
 ***********************************************************/
  $postId = (int) $_GET['postId'];
  echo @ json_encode(getCommentByPostId($postId));
  
?>