<?php

 /***********************************************************
 *  Include sessions
 ***********************************************************/
  require("includes/sessions.inc.php");

 /***********************************************************
 *  Include Layout Functions
 ***********************************************************/
 require_once('includes/layoutFunctions.inc.php');

 /***********************************************************
 *  Reset session data
 ***********************************************************/
 $_SESSION = array();
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
 
<?
 /***********************************************************
 *  Set Page Title, Script, and Head
 ***********************************************************/
 $pageTitle = "Sign In";
 $pageScript = "scripts/login.js";
 
 require("includes/head.inc.php")
 
 /***********************************************************
 *  Display page
 ***********************************************************/
?>

<body>
    
     <div id="wrapper">
          <div id="content">
    
               <? require("includes/body_top.inc.php") ?>

               <div id="contentarea">
                
                    <div id="mainarea">
 
                      <div id="javascriptRequired">
                         JavaScript must be enabled for this application.
                         <br />
                         Please enable JavaScript and refresh this page.
                      </div>
<?php

 /***********************************************************
 *  Cookie enabled check (cookie set in sessions.inc.php file)
 ***********************************************************/ 
 if(!isset($_COOKIE['cookiecheck'])) {
    echo '<div class="errorMessage">'
         .'<h3>Cookies must be enabled to access this site.</h3>'
         .'<p>Please enable cookies for this site and refresh the page.</p>'
         .'</div>';
    echo  "</div></div></div></body></html>";
    exit();
 }

 /***********************************************************
 *  Submit check
 ***********************************************************/
 if(isset($_POST['submit'])) {
                 
    $id = @ findId($_POST['txtUsername'], $_POST['txtPassword']);

    if (!$id > 0) {
        unset($_SESSION);
        echo '<div class="errorMessage"><h3>invalid username and password combination</h3></div>';
        displayLogin();
        
    } else {
            
        $_SESSION['id'] = $id;
        $sessionHash = hash("sha1",$_SESSION['id']);
        setcookie('bloggerId', $sessionHash);
        header('location: index.php');
        exit();
    }
    
 } else {
     displayLogin();
 }

?>
                    </div>
               </div>
           </div>

</body>
</html>

