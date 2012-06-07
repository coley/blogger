<?php

 /***********************************************************
 * Includes
 ***********************************************************/
 require_once('../includes/services.inc.php');

 /***********************************************************
 * Add Post
 ***********************************************************/
  $user_id = @ findUserId($_SESSION['id']);
  $title = $_GET['title'];
  $description = $_GET['description'];
  
  if (strlen($user_id) > 0 && strlen($title) > 0 && strlen($description) > 0) {
     echo @ addPost($user_id, $title, $description); 
  } else {
     echo 0;
  }
  
?>