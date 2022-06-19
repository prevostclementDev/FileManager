<?php

    // TODO message erreur à faire en cas de problème

    /* UPDATE PREFERENCE ACCES */
    if(isset($_POST['modification-pref'])) {

        update_pref(
            $_POST['forWhat'],
            'acces',
            htmlspecialchars($_POST['accesLocal-pref']),
            $acces_preference,
        );

        update_pref(
            $_POST['forWhat'],
            'server',
            htmlspecialchars($_POST['accesServeur-pref']),
            $acces_preference,
        );

        update_pref(
            $_POST['forWhat'],
            'name',
            htmlspecialchars($_POST['name-pref']),
            $acces_preference,
        );

        header("Location: http://localhost/");

    }

     /* DELETE PREFERENCE ACCES */
    if(isset($_POST['suppression-pref'])) {

        delete_pref_by_name(
            htmlspecialchars($_POST['forWhat']),
            $acces_preference,
        );

        header("Location: http://localhost/");

    }

    /* ACTIVE PREFERENCE ACCES */
    if(isset($_POST['active-pref'])) {

        active_pref(
            htmlspecialchars($_POST['forWhat']),
            $acces_preference,
        );

        header("Location: http://localhost/");

    }


    /* DESACTIVE PREFERENCE ACCES */
    if(isset($_POST['desactive-pref'])) {

        desactive_pref(
            htmlspecialchars($_POST['forWhat']),
            $acces_preference,
        );

        header("Location: http://localhost/");

    }

    /* DESACTIVE PREFERENCE ACCES */
    if(isset($_POST['add-pref'])) {

            add_pref(
                htmlspecialchars($_POST['preferenceName']),
                'false',
                htmlspecialchars($_POST['preferenceAcces']),
                htmlspecialchars($_POST['preferenceAccesServeur']),
                $acces_preference,
            );
    
            header("Location: http://localhost/");
    }
    