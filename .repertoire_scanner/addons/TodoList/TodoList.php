<?php

class TodoList {

    public string $name = 'TodoList';
    public string $title = 'TodoList';
    public string $icon;
    public string $url = 'frame|http://localhost/.repertoire_scanner/addons/TodoList/view/';
    public bool $active = true;
    public int $order = 5;

    public function __construct() {
        $this->icon =  './.repertoire_scanner/addons/TodoList/icon.png';
    }

}