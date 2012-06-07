<?php

 /***********************************************************
 *  Include sessions
 ***********************************************************/
  require("includes/sessions.inc.php");

 /***********************************************************
 *  Include Layout
 ***********************************************************/
 require_once('includes/layoutFunctions.inc.php');
 
 ?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html>
 
 <?
 /***********************************************************
 *  Set Page Title, Script, and Head
 ***********************************************************/
 $pageTitle = "Posts";
 $pageScript = "scripts/blog.js";

 require("includes/head.inc.php");

 /***********************************************************
 *  Display index page
 ***********************************************************/
?>

<body>
    
     <div id="wrapper">
          <div id="content">
    
               <? require("includes/body_top.inc.php") ?>

               <div id="contentarea">
                
                    <div id="mainarea">

<?php
 if (!(isset($_COOKIE['bloggerId']) && $_SESSION['id'])) {
    header('location: login.php');
    exit();
 } elseif (hash("sha1",$_SESSION['id']) == $_COOKIE['bloggerId']) {
    displayPosts();
 } else {
    header('location: login.php');
    exit();
 }
?>
                    </div>
               </div>
           </div>

</body>
</html>