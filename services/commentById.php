<?php

 /***********************************************************
 * Includes
 ***********************************************************/
 require_once('../includes/services.inc.php');

 /***********************************************************
 * Return json of given post
 ***********************************************************/
  echo @ json_encode(getCommentByCommentId($_GET['commentId']));

?>