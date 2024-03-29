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

    public function getAddons(String $type = 'linkShortCut') : array|bool {

        if ( empty($this->addons) ) {
            $this->addonsScanner();
        }

        if ( $this->scanStatus ) {
            return array_filter(
                $this->addons,
                function($addons) use ($type) {
                    return ($addons->type === $type) ? $addons : false;
                }
            );
        }

        return $this->scanStatus;
    }

// #########################
// ##### DISPLAYER #########
// #########################

    public function displayAddonsBar() : void {

        echo '<div class="addons">';
        foreach( $this->getAddons() as $value ) {

            if ( $value->active ) {
                $url = $value->url;
                $class = '';
                if ( str_contains( $value->url , 'frame|' ) ) {
                    $url = explode('|',$value->url)[1];
                    $class = 'iframeOpener';
                }

                ?>
                <a target="_blank" class="cells <?= $class ?>" href="<?= $url  ?>" style="order: <?= $value->order ?>;">
                    <div class="logo" style="background: url('<?= $value->icon ?>'); background-position: center; background-size: contain; background-repeat: no-repeat;"></div>
                </a>
                <?php
            }

        }
        echo '</div>';

    }

}