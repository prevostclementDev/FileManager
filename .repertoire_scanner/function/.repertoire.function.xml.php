<?php
    $acces_preference = '.repertoire_scanner/preference/pref.xml';

    function readXmlToTab(string $XmlNameFile): array
    {
        $return = array();


        if(file_exists($XmlNameFile)) {

            $lectureXml = simplexml_load_file($XmlNameFile);
 
            foreach ( $lectureXml as $pref ) {
    
                $return[strval($pref->name)] = array(
                    "name"   => strval($pref->name),
                    "active" => strval($pref->active),
                    "acces"  => strval($pref->acces_pref->local),
                    "server" => strval($pref->acces_pref->server),
                );
    
            }
    
            if ( !empty($return) ) {
            
                return array(true,$return);
    
            } else {
    
                return array(false,"Pas d'élément");
    
            }

        } else {


            return array(false,"Fichier n'existe pas");

        }


        return array(false);
    }

    function create_pref(array $tab_preference,string $XmlNameFile) : bool {

        $newXml = new DOMDocument('1.0','utf-8');
        $newXml->appendChild($allPreference = $newXml->createElement('all_preference'));

        foreach ( $tab_preference as $preference ) {

            $allPreference->appendChild($pref = $newXml->createElement('preference'));

            $pref->appendChild($newXml->createElement('name',$preference['name']));
            $pref->appendChild($newXml->createElement('active',$preference['active']));
            $pref->appendChild($acces = $newXml->createElement('acces_pref'));
    
            $acces->appendChild($newXml->createElement('local',$preference['acces']));
            $acces->appendChild($newXml->createElement('server',$preference['server']));


        }

        $newXml->formatOutput = true;
        $newXml->save($XmlNameFile);

        return true;

    }

    function delete_pref_by_name(string $name,string $XmlNameFile) : array {

        $XmlFile = readXmlToTab($XmlNameFile);

        if($XmlFile[0]) {

            if ( array_key_exists( $name , $XmlFile[1] ) ) {

                unset($XmlFile[1][$name]);
    
                create_pref($XmlFile[1],$XmlNameFile);
    
                return array(true,$XmlFile[1]);
    
            } else {
    
                return array(false,'Element non existant',$XmlFile);
    
            }

        } else {

            return array(false,$XmlFile[1]);

        }

    }

    function add_pref(string $name,string $active,string $acces,string $server,string $XmlNameFile) : array {

        $XmlFile = readXmlToTab($XmlNameFile);

        if($XmlFile[0]) {

            if ( array_key_exists( $name , $XmlFile[1] ) ) {

                return array(false,'Préférence existe déjà');

            } else {

                $XmlFile[1][$name] = array(
                    "name" => $name,
                    "active" => $active,
                    "acces" => $acces,
                    "server" => $server
                );

                create_pref($XmlFile[1],$XmlNameFile);
                return array(true,'add in xml file '.$XmlNameFile);

            }

        } else {

            $XmlTabClean = array(array(
                "name" => $name,
                "active" => $active,
                "acces" => $acces,
                "server" => $server
            ));

            create_pref($XmlTabClean,$XmlNameFile);
            return array(true,'add in xml file '.$XmlNameFile);

        }

    }

    function update_pref(string $name_pref,string $how_change,string $value_change,string $XmlNameFile)  : array {

        $XmlFile = readXmlToTab($XmlNameFile);

        if($XmlFile[0]) {

            if( array_key_exists($name_pref,$XmlFile[1]) && array_key_exists($how_change,$XmlFile[1][$name_pref]) ) {

                $XmlFile[1][$name_pref][$how_change] = $value_change;
    
                create_pref($XmlFile[1],$XmlNameFile);
                return array(true,'modification effectué');

            } else {

                return array(false,'clé inexistante');

            }

        } else {

            return $XmlFile;

        }

    }

    function active_pref(string $name,string $XmlNameFile) : array {

        $Allpref = readXmlToTab($XmlNameFile);

        if ( $Allpref[0] ) {

            foreach( $Allpref[1] as $pref) {

                if ( $pref['active'] == 'true' ) {

                    update_pref($pref['name'],'active','false',$XmlNameFile);

                }

                if ( $pref['name'] == $name ) {

                    update_pref($pref['name'],'active','true',$XmlNameFile);

                }

            }

            return array(true);

        } else {

            return $Allpref;

        }

    }

    function desactive_pref(string $name,string $XmlNameFile) : array {

        $Allpref = readXmlToTab($XmlNameFile);

        if ( $Allpref[0] ) {

            foreach( $Allpref[1] as $pref) {

                if ( $pref['name'] == $name ) {

                    update_pref($pref['name'],'active','false',$XmlNameFile);

                }

            }

        } else {

            return $Allpref;

        }
        return array(false);
    }

    function get_active_pref(string $XmlNameFile) : array {

        $Allpref = readXmlToTab($XmlNameFile);

        if( $Allpref[0] ) {

            foreach($Allpref[1] as $pref){

                if( $pref['active'] == 'true' ) {

                    return array(true,$pref);

                }
    
            }

            return array(false,'no value');

        } else {

            return $Allpref;

        }

    }