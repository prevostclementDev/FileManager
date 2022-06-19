<?php
    require_once '.repertoire_scanner/.repertoire.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=".repertoire_scanner/css/style.css">

    <link rel="apple-touch-icon" sizes="180x180" href=".repertoire_scanner/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href=".repertoire_scanner/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href=".repertoire_scanner/images/favicon/favicon-16x16.png">
    <link rel="manifest" href=".repertoire_scanner/images/favicon/site.webmanifest">

    <meta class="metaAcces" data-acces="<?= $acces ?>" >
    <title>File Manager</title>
</head>

    <body>
        <!-- ######################### -->
        <!--        NAV BAR            -->
        <!-- ######################### -->
        <nav>

            <div class="left-info">
                <h1> LocalHost File Manager </h1>
                <h2> Accès local : <?= $acces ?></h2>
                <h2> Accès serveur : <?= $acces_serveur ?> </h2>
            </div>

            <div class="right-btn">

                <?php
                
                if(isset($server) && $server != "") {

                echo '<a target="_blank" href="'.$server.'/phpmyadmin/">PhpMyAdmin</a>';

                }

                ?>

                <a class="parameterBtn" > <img src=".repertoire_scanner/images/addons/parameter.png" alt=""> </a>

            </div>

        </nav>
        
        <!-- ######################### -->
        <!--        SEARCH BUTTON       -->
         <!-- ######################### -->
        <div class="search-input">
                <?= $_SERVER['SERVER_SIGNATURE']; ?>

                <input type="text" id="search-input-text" placeholder="Search Bar">
                <button>Advenced</button>

        </div>

        <!-- ######################### -->
        <!--        DISPLAY LIST       -->
         <!-- ######################### -->
         <div class="list-file">
            <h3>
                <?php
                    if( isset($parent_get_url) && $parent_get_url != "" ) {
                        ?>
                            <a class="goBack" href="<?php
                            
                            if ( $parentD_false_xml && parent_directory($acces_serveur) ==  $parent_get_url) {

                               echo $server;

                            } else {

                                echo  $parent_get_url;

                            }
                            ?>">Go To Parent</a>

                        <?php
                    }

                ?>

            </h3>
            <?php 

                if($list[0]) {

                    if( !isset($parent_get_url) || $parent_get_url == "" && $parentD_false_xml == false ) {

                        unset($list[1]['index.php']);

                     }
                        
                     display_listing($list[1],$AllListing);
        
                } else {

                    echo $list[1];

                }

            ?>

        </div>


        <!-- ######################### -->
        <!-- POP UP TO ADVENCED SEARCH -->
         <!-- ######################### -->
        <div class="search-pop-up">

            <div class="content">

                <input type="text" id="AdvencedName" placeholder="file name">

                <input type="submit" id="AdvencedSubmit" value="search">

                <div class="close">
                    <a>close</a>
                </div>

            </div>

        </div>

        <!-- ######################### -->
        <!-- POP UP PARAMETER -->
        <!-- ######################### -->

        <div class="pop-up-parameter">

            <div class="containeur-mid">
            <div class="leave">
                Leave
            </div>

                <div class="choise">

                    <ul>
                        <li open-zone="acces" class="active">Acces scan</li>
                    </ul>

                </div>

                <div class="changeZone">

                    <div class="acces active">

                            <div class="selecteur">

                            <label for="" >Choisir une préférence :</label>
                            <select name="" id="preference-select-parameter">

                            <?php 
                            
                            $XmlRead = readXmlToTab($acces_preference);
                            $MyActivePref = get_active_pref($acces_preference);
                            
                            if( $XmlRead[0] ) {

                                foreach($XmlRead[1] as $value) {
                                    $selectOption = "";

                                    if( $MyActivePref[0] != false ) {

                                        if ( $value['name'] == $MyActivePref[1]['name'] ) {

                                            $selectOption = "selected";

                                        } 

                                    }

                                    ?>
                                    
                                    <option value="<?= $value['name'] ?>"  <?= $selectOption ?>><?= $value['name'] ?></option>

                                    <?php

                                }

                            }

                            ?>
                                </select>

                            </div>

                            <?php

                            if( $XmlRead[0] ) {

                                $i = 0;
                                foreach($XmlRead[1] as $value) {
                                ?>
                                
                                <div class="acces-element 
                                
                                <?php
                                
                                    if ( $MyActivePref[0] != false ) {

                                        if ( $value['name'] == $MyActivePref[1]['name'] ) {

                                            echo 'active';

                                        } 

                                    } else {

                                        if ( $i == 0 ) {

                                            echo 'active';

                                        }

                                    }
                                
                                ?>
                                
                                <?= $value['name'] ?>

                                default">

                                    <form action="" method="post" class="modification-form">

                                        <h2><?= $value['name'] ?></h2>
                                        <input type="text" name="name-pref" placeholder="nom préférence" value="<?= $value['name'] ?>">
                                        <input type="text" name="accesLocal-pref" placeholder="acces local" value="<?= $value['acces'] ?>">
                                        <input type="text" name="accesServeur-pref" placeholder="acces serveur" value="<?= $value['server'] ?>">

                                        <input type="text" value="<?= $value['name'] ?>" name="forWhat" style="display:none;">

                                        <input type="submit" name="modification-pref" value="Modifier">
                                        
                                    </form>

                                    <form action="" method="post" class="delete-form">

                                        <input type="text" value="<?= $value['name'] ?>" name="forWhat" style="display:none;">

                                        <input type="submit" name="suppression-pref" value="Supprimez">

                                    </form>

                                     <?php
                                
                                        if ( $MyActivePref[0] != false ) {

                                            if ( $value['name'] == $MyActivePref[1]['name'] ) {

                                                ?>
                                                <form action="" method="post" class="desactive-form">

                                                    <input type="text" value="<?= $value['name'] ?>" name="forWhat" style="display:none;">

                                                    <input type="submit" name="desactive-pref" value="désactivé">

                                                </form>
                                                <?php

                                            } else {

                                                ?>
                                                <form action="" method="post" class="active-form">
    
                                                    <input type="text" value="<?= $value['name'] ?>" name="forWhat" style="display:none;">
    
                                                    <input type="submit" name="active-pref" value="Activer">
    
                                                </form>
                                                <?php

                                            }

                                        } else {

                                            ?>
                                            <form action="" method="post" class="active-form">

                                                <input type="text" value="<?= $value['name'] ?>" name="forWhat" style="display:none;">

                                                <input type="submit" name="active-pref" value="Activer">

                                            </form>
                                            <?php

                                        }
                                
                                    ?>

                                </div>

                                <?php
                                $i++;
                                }
                            } else {

                                echo $XmlRead[1];

                            }


                            ?>
                            <div class="create-acces">

                                <form action="" method="post">

                                <h2> Ajout de préférence : </h2>

                                    <input type="text" name="preferenceName" id="" placeholder="nom de la préférence">
                                    <input type="text" name="preferenceAcces" id="" placeholder="acces local de la préférence">
                                    <input type="text" name="preferenceAccesServeur" id="" placeholder="acces serveur de la préférence">

                                    <input type="submit" name="add-pref" value="ajouter">

                                </form>

                            </div>
                    </div>

                </div>

            </div>

        </div>

    </body>

    <script src=".repertoire_scanner/js/script_mane.js"></script>

</html>