<?php

class googleAgenda {

    public string $name = 'googleAgenda';
    public string $title = 'agenda';
    public string $icon;
    public string $url = 'https://calendar.google.com/calendar/u/0/r/month';
    public bool $active = true;
    public int $order = 2;

    public string $type = 'linkShortCut';

    public function __construct() {

        $this->icon =  './.repertoire_scanner/addons/googleAgenda/icon.png';

    }

}
