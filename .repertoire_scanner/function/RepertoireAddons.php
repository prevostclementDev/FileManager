<?php

class RepertoireAddons {

    private string $addonsAcces;
    private array|false $scandir;
    private bool $scanStatus = false;

    public array $addons = array();

    public function __construct(){
        $this->addonsAcces = $_SERVER['DOCUMENT_ROOT'].'/.repertoire_scanner/addons/';
        $this->scandir = scandir($this->addonsAcces);
    }

    private function isDir() : bool {
        return is_array($this->scandir);
    }

    private function addonsScanner() : void {

        if ( $this->isDir() ) {
            foreach ($this->scandir as $addonsDirectory) {
                if ( $addonsDirectory != '.' && $addonsDirectory != ".." && $addonsDirectory != 'RepertoireAddons.php' ) {
                    $this->addons[] = new $addonsDirectory;
                }
            }
            $this->scanStatus = true;
        } else {
            $this->scanStatus = false;
        }

    }

    public function getAddons() : array|bool {

        if ( empty($this->addons) ) {
            $this->addonsScanner();
        }

        if ( $this->scanStatus ) {
            return $this->addons;
        }
        return $this->scanStatus;
    }

}