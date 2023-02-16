<?php

class GithubAddons {

    public string $name = 'GithubAddons';
    public string $title = 'Github';
    public string $icon;
    public string $url = 'https://github.com/prevostclementDev';
    public bool $active = true;
    public int $order = 3;

    public function __construct() {

        $this->icon =  './.repertoire_scanner/addons/GithubAddons/icon.png';

    }

}