<?php

 /***********************************************************
 *  Start Sessions
 ***********************************************************/
  session_start();
  session_regenerate_id();

 /***********************************************************
 *  Verify logged in user
 ***********************************************************/
  if (!(isset($_COOKIE['bloggerId']) && $_SESSION['id'])) {
    header('location: ../login.php');
    exit();
 }
 
 if (hash("sha1",$_SESSION['id']) != $_COOKIE['bloggerId']) {
    header('location: ../login.php');
    exit();
 } 

 /***********************************************************
 * Includes
 ***********************************************************/
 require_once('../includes/postDataAccess.inc.php');
 require_once('../includes/userDataAccess.inc.php');
 require_once('../includes/commentDataAccess.inc.php');

?>