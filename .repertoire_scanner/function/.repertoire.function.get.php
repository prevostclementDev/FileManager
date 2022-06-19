<?php
    session_start();

    if(isset($_GET['acces']) && isset($_GET['acces_serveur'])) {

        $old_acces = $acces;
    
        $acces = $_GET['acces'];
        $acces_serveur = $_GET['acces_serveur'];

        if(format_old_acces($old_acces)[0] == parent_directory($acces)) {
    
            $parent_get_url = parent_directory($acces_serveur);
    
        } else {
    
            $parent_get_url = '?acces='.parent_directory($acces).'&acces_serveur='.parent_directory($acces_serveur).'';
                
        }
    
    } else {

        $_SESSION['base_acces'] = array($acces,$acces_serveur);

    }


    