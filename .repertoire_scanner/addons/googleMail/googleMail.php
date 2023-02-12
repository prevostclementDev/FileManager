<?php

class googleMail {

    public string $name = 'googleMail';
    public string $title = 'gmail';
    public string $icon;
    public string $url = 'https://mail.google.com/mail/u/0/#inbox';
    public bool $active = true;
    public int $order = 1;

    public function __construct() {

        $this->icon =  './.repertoire_scanner/addons/googleMail/icon.png';

    }

}