<?php

    require_once '../autoload.php';

    $ListingRepo = new RepertoireListingAdvenced();

    if ( $ListingRepo->sendApi() ) {
        $ListingRepo->jsonFormatListing();
    } else {
        $ListingRepo->jsonFormatError('argument not valid');
    }