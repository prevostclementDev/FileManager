<?php

        /* #################### */
        /* GET PARENT DIRECTORY */
        /* #################### */
        function parent_directory($acces) : string {

            $destroy_link = explode("/",$acces,-1);
            $parent_acces = "";
    
            for($i=0;$i<sizeof($destroy_link)-1;$i++){
    
                $parent_acces .= $destroy_link[$i]."/";
    
            }
    
            return $parent_acces;
    
        }
    
        /* ############################### */
        /* GET FORMAT OF URL WITHOUT $_GET */
        /* ############################### */
        function format_old_acces($acces_old) : array {
    
            $acces_old = explode("?",$acces_old,-1);
    
            return $acces_old;
    
        }