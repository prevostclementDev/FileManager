<?php

class hostinger {

    public string $name = 'hostinger';
    public string $title = 'hostinger';
    public string $icon;
    public string $url = 'https://hpanel.hostinger.com/hosting/clementprevost.fr/old';
    public bool $active = true;
    public int $order = 4;

    public string $type = 'linkShortCut';

    public function __construct() {

        $this->icon =  './.repertoire_scanner/addons/hostinger/icon.png';

    }

}
