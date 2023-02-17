<?php

class HyperPlanning {

    public string $name = 'HyperPlanning';
    public string $title = 'hyperPlanning';
    public string $icon;
    public string $url = 'https://annecy-02-1.hyperplanning.fr/hp/etudiant?identifiant=pz8kFR6R3C2wyuzP';
    public bool $active = true;
    public int $order = 0;

    public string $type = 'linkShortCut';

    public function __construct() {
        $this->icon =  './.repertoire_scanner/addons/HyperPlanning/icon.png';
    }

}