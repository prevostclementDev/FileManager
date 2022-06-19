<?php
/* ############################## */
/* LISTING FILE AND RETURN ARRAY */
/* ############################## */

function listing_file($acces,$server_url,$support_file,$AllListing) : array {
    if(is_dir($acces)) { // SI ON PARCOURS PAS UN FICHIER Ex : .php

        $return_value = array(); // RETURN
        $scan = scandir($acces); // SCAN FOLDER

        if($scan != false) {

            foreach($scan as $fichier) { // RUN FOLDER

                if( substr($fichier,0,1) != "." ) { // TOUT LES FICHIER QUI COMMENT PAR UN POINT NE SONT PAS COMPRIS
                    $childs_values = false;

                    if(is_dir($acces.$fichier)) {

                        $is_file = false;
                        $acces_file_name = $fichier."/";
                        $icone_acces = $support_file['folder'];

                        if($AllListing) {
                            $childs_values = listing_file(
                                $acces.$acces_file_name,
                                $server_url.$acces_file_name,
                                $support_file,$AllListing
                            )[1];

                        } else {

                            $childs_values = true;

                        }
                        
                
                    } else {
                
                        $is_file = true;
                        $acces_file_name = $fichier;
                        $icone_acces = get_icone_acces($fichier,$support_file);

                    }

                    // ADD VALUE
                    $return_value[$fichier] =
                    array(
                        "filename"        => $fichier,
                        "parent_acces"    => $acces,
                        "acces"           => $acces.$acces_file_name,
                        "serveur_acces"   => $server_url.$acces_file_name,
                        "is_file"         => $is_file,
                        "childs_values"   => $childs_values,
                        "icone"           => $icone_acces,
                    );
        
                }
    
            }

            return array(true,$return_value); // RETURN TRUE

        } else {

            return array(false,"scan error, the function scanDir just work on local");

        }

    } else {

        return array(false,"can't scan file just folder"); // IF IS FILE : RETURN FALSE

    }

}

/* ############################## */
/*      GET EXTENSION OF FILE     */
/* ############################## */

function get_extension($the_file) : string {

    $extension = explode('.',$the_file);
    return end($extension);

}

/* ############################## */
/*          GET ICONE ACCES       */
/* ############################## */
function get_icone_acces($file,$support_file)  {

    if(is_string($file)) {

        $file_extension = get_extension($file);

        if( array_key_exists($file_extension,$support_file) ) {

            return $support_file[$file_extension];

        } else {

            return $support_file["default"];

        }

    }

} 