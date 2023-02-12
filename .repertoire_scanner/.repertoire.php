<?php

    require_once 'autoload.php';

    $addonsRepo = new RepertoireAddons();
    $accesRepo = new RepertoireAcces();
    $ListingRepo = new RepertoireListing();

    $addons = $addonsRepo->getAddons();
