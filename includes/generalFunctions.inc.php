<?php  
  
    /*****************************************************************
     *  Function formats input for display (assumes input has had
     *  slashes added to it already)
    *****************************************************************/
    function formatForDisplay($input) {
        
        //Remove escape characters       
        $output = stripslashes($input);
        
        //Convert convert any non-HTML characters that correspond to HTML
        //special characters to their HTML equivalents.
        //$output = htmlspecialchars_decode($output);
        
        //Return
        return $output;
        
    }
    
    /*****************************************************************
     *  Function prepares data for database
    *****************************************************************/
    function prepareDataForDatabase($input) {
        //Declare variables
        $newlines = array("\r\n", "\n", "\r", "\n\r");
        $replace = ' ';
        
        //Replace line break characters
        $output = str_replace($newlines,$replace, $input);
                                
        //Escape quotes if magic quotes are not on        
        if(!get_magic_quotes_gpc()) {
            $output = addslashes($output);
        }
        
        //Convert HTML special characters to non-HTML characters
        $output = htmlspecialchars($output);
                        
        //Return
        return $output;

    }

?>