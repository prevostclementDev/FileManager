<?php

class RepertoireAcces {

    private string $old_acces = '';
    private string $parent_get_url = '';
    private string $server = '';
    private string $acces;
    private string $acces_serveur;

    public function __construct() {

        $this->server = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']; // BASE SERVER URL

        $this->acces = $_SERVER['CONTEXT_DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']; // LOCAL ACCES
        $this->acces_serveur = $this->server.$_SERVER['REQUEST_URI']; // SERVEUR ACCES

        $this->getChecker($_GET);

    }

    public function parent_directory($acces) : string {

        $destroy_link = explode("/",$acces,-1);
        $parent_acces = "";

        for($i=0;$i<sizeof($destroy_link)-1;$i++){

            $parent_acces .= $destroy_link[$i]."/";

        }

        return $parent_acces;

    }

    public function format_old_acces(String $acces_old) : array {

        return explode("?",$acces_old,-1);

    }

    private function getChecker(array $get) : void {

        session_start();

        if(isset($get['acces']) && isset($get['acces_serveur'])) {

            $this->old_acces = $this->acces;

            $this->acces = $get['acces'];
            $this->acces_serveur = $get['acces_serveur'];

            if($this->format_old_acces($this->old_acces)[0] == $this->parent_directory($this->acces)) {

                $this->parent_get_url = $this->parent_directory($this->acces_serveur);

            } else {

                $this->parent_get_url = '?acces='.$this->parent_directory($this->acces).'&acces_serveur='.$this->parent_directory($this->acces_serveur);

            }

        } else {

            $_SESSION['base_acces'] = array($this->acces,$this->acces_serveur);

        }

    }

//    ########################
//    ######## GETTER ########
//    ########################

    public function getOldAcces() {
        return $this->old_acces;
    }

    public function getParentGetUrl() {
        return $this->parent_get_url;
    }

    public function getServer() {
        return $this->server;
    }

    public function getAcces() {
        return $this->acces;
    }

    public function getAccesServeur() {
        return $this->acces_serveur;
    }

// #########################
// ##### DISPLAYER #########
// #########################

    public function displayMetaAcces() {
        ?>
        <meta class="metaAcces" data-acces="<?= $this->acces ?>" >
        <meta class="metaAccesUrl" data-accesUrl="<?= $this->acces_serveur ?>">
        <?php
    }

    public function displayParentButton(String $class = "goBack",String $intitule = "parent directory") {
        if( $this->getParentGetUrl() != "" ) {
            ?>
            <a class="<?= $class ?>" href="<?php

            if ( $this->parent_directory($this->getAccesServeur()) ==  $this->getParentGetUrl()) {

                echo $this->getServer();

            } else {

                echo  $this->getParentGetUrl();

            }
            ?>"><?= $intitule ?></a>

            <?php
        }
    }

    public function displayPhpMyAdmin(String $class = "", String $target = "_blank" , String $intitule = "PhpMyAdmin"){
        if( $this->server != "") {
            echo '<a class="'.$class.'" target="'.$target.'" href="'.$this->server.'/phpmyadmin/">'.$intitule.'</a>';
        }
    }

}