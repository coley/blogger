<?php

 /***********************************************************
 * Includes
 ***********************************************************/
 require_once('../includes/services.inc.php');

 /***********************************************************
 * Return user id
 ***********************************************************/
 echo @ findUserId($_SESSION['id']);

?>