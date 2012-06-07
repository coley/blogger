<div id="header">
                
    <div id="logo">
        <a href="index.php"><h1 id="logoName">Blogger</h1></a>
    </div>
                
    <div id="headerMenu">    
        <div id="headerTopContainer">
            <?php
                if ($_SESSION["id"] > 0) {
                    echo '<span id="welcomeLinkSignedIn">'
                          .'Welcome '.findUserId($_SESSION['id']).'!&nbsp;&nbsp;'
                          .'<a href="login.php">sign out</a></span>';
                } 
            ?>
        </div>
    </div>
                    
    <div id="menulinks">
        <!--<ul>                  
            <li><a href="index.php">Home</a></li>
        </ul>-->
    </div>
                
</div>
                
<div id="mainimg">&nbsp;</div>
