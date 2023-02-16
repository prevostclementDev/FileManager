<?php
/**
 * @var $support_file
 * @var $accesAddonsForIcon
 */

    if( isset($_GET['search_advenced']) && is_string($_GET['search_advenced'] ) ) {

        require_once '../.repertoire.php';

        $list_search = listing_file(
            $_GET['acces'],
            $_GET['acces_serveur'],
            $support_file,
            true,
            array(
                'node_modules',
                'vendor'
            )
        )[1];


        echo json_encode(AdvencedSearch($list_search,$_GET['search_advenced'],$result=[]));

    } else {

        echo json_encode(array(false,'No get in url'));

    }

    /* ################################## */
    /*      ADVENCED SEARCH FUNCTION      */
    /* ################################## */
    function AdvencedSearch($list_search,$howSearch) : array {
        $result=[];
        
        foreach($list_search as $key => $folder) {

            if( str_contains(strtolower($folder['filename']),strtolower($howSearch)) !== false ) {

                $result[] =
                array(

                    "filename" => $folder['filename'],
                    "parent_acces" => $folder["parent_acces"],
                    "acces" => $folder["acces" ],
                    "serveur_acces" => $folder["serveur_acces"],
                    "is_file" => $folder["is_file"],
                    "childs_values" => false,
                    "icone" => $folder["icone"],

                );
                
            }
            if ( $folder['childs_values'] != false || !empty($folder["childs_values"]) ) {
                
                 foreach(AdvencedSearch($folder['childs_values'],$howSearch) as $value ) {

                    $result[] = $value;

                 }

            }

        }
        return $result;
    }

