<?php

 /***********************************************************
 * Includes
 ***********************************************************/
 require_once('../includes/services.inc.php');

 /***********************************************************
 * Add Post
 ***********************************************************/
  $user_id = @ findUserId($_SESSION['id']);
  $post_id = $_GET['postId'];
  $description = $_GET['description'];
  
  if (strlen($user_id) > 0 && $post_id > 0 && strlen($description) > 0) {
     echo @ addComment($user_id, $post_id, $description);
  } else {
     echo 0;
  }
  
?>