<?php require("includes/userDataAccess.inc.php"); ?>

<head>
    <link href="stylesheets/invention/style.css" rel="stylesheet" type="text/css" />
    <link href="stylesheets/lightness/lightness.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    
    <?php
        if (isset($pageScript)) {
            echo '<script type="text/javascript" src="'.$pageScript.'"></script>';
        }
    ?>
    
    <title>
        <?php
            if (isset($pageTitle)) {
                echo $pageTitle;
            } else {
                echo 'Blog';
            }
        ?>
    </title>
    
</head>