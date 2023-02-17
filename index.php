<?php
    require_once '.repertoire_scanner/.repertoire.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=".repertoire_scanner/assets/css/style.css">

    <link rel="apple-touch-icon" sizes="180x180" href=".repertoire_scanner/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href=".repertoire_scanner/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href=".repertoire_scanner/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href=".repertoire_scanner/assets/images/favicon/site.webmanifest">

    <meta name='robots' content='noindex, nofollow' />

    <?php $accesRepo->displayMetaAcces() ?>
    <title>File Manager</title>
</head>

    <body>
        <!-- ######################### -->
        <!--        NAV BAR            -->
        <!-- ######################### -->
        <nav>

            <div class="left-info">
                <h1> LocalHost File Manager </h1>
                <h2> Accès local : <?= $accesRepo->getAcces() ?></h2>
                <h2> Accès serveur : <?= $accesRepo->getAccesServeur() ?> </h2>
            </div>

            <div class="right-btn">
                <?php $accesRepo->displayPhpMyAdmin(
                        '',
                        '_blank',
                        'SQLgestion'
                ); ?>
<!--                <a class="parameterBtn" > <img src=".repertoire_scanner/assets/images/addons/parameter.png" alt=""> </a>-->
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
                <?php $accesRepo->displayParentButton(
                        'goBack',
                      'Parent folder'
                ); ?>
            </h3>
            <?php $ListingRepo->display_listing(
                    $accesRepo->getAcces() ,
                    $accesRepo->getAccesServeur() ,
                    $accesRepo->getParentGetUrl() ,
                    []
            ); ?>

        </div>

        <!-- ######################### -->
        <!--        IFRAME ADDONS      -->
        <!-- ######################### -->

        <div class="iframeAddons">
            <iframe src=""></iframe>
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

<!--        <div class="pop-up-parameter">-->
<!---->
<!--            <div class="containeur-mid">-->
<!--            <div class="leave">-->
<!--                Leave-->
<!--            </div>-->
<!---->
<!--                <div class="choise">-->
<!---->
<!--                    <ul>-->
<!--                        <li open-zone="test1" class="active">test 1</li>-->
<!--                        <li open-zone="test2">test 2</li>-->
<!--                        <li open-zone="test3">test 3</li>-->
<!--                    </ul>-->
<!---->
<!--                </div>-->
<!---->
<!--                <div class="changeZone">-->
<!---->
<!--                    <div class="test1">-->
<!--                        <h1>test 1</h1>-->
<!--                    </div>-->
<!---->
<!--                    <div class="test2">-->
<!---->
<!--                        <h1>test 2</h1>-->
<!--                        -->
<!--                    </div>-->
<!---->
<!--                    <div class="test3">-->
<!---->
<!--                        <h1>test 3</h1>-->
<!--                        -->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->

        <!-- ######################### -->
        <!-- ADDONS -->
        <!-- ######################### -->

        <?php $addonsRepo->displayAddonsBar() ?>


    </body>

    <script src=".repertoire_scanner/assets/js/script_mane.js"></script>
    <script src=".repertoire_scanner/assets/js/addonsIframe.js"></script>
</html>