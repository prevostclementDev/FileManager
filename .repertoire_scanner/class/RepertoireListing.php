<?php

class RepertoireListing {

    private bool $AllListing;
    private array $support_file = array(
        "php"     => ".repertoire_scanner/assets/images/icone/php.svg",
        "js"      => ".repertoire_scanner/assets/images/icone/js.svg",
        "css"     => ".repertoire_scanner/assets/images/icone/css.png",
        "scss"    => ".repertoire_scanner/assets/images/icone/scss.png",
        "sass"    => ".repertoire_scanner/assets/images/icone/scss.png",
        "xml"    => ".repertoire_scanner/assets/images/icone/xml.png",
        "html"   => ".repertoire_scanner/assets/images/icone/html.png",
        "default" => ".repertoire_scanner/assets/images/icone/default.png",
        "folder"  => ".repertoire_scanner/assets/images/icone/folder.png",
        "jpg"     => ".repertoire_scanner/assets/images/icone/img.png",
        "jpeg"     => ".repertoire_scanner/assets/images/icone/img.png",
        "png"     => ".repertoire_scanner/assets/images/icone/img.png",
        "svg"     => ".repertoire_scanner/assets/images/icone/img.png",
    );

    private array $listing = [];

    public function __construct(bool $AllListing = false) {
        $this->AllListing = $AllListing;
    }

    public function display_listing($acces,$server_url,$parentUrl,$notIncludeArray) : void {

        if ( empty($this->listing) ) {
            $this->listing = $this->listing_file($acces,$server_url,$notIncludeArray);
        }

        if ( $this->listing[0] ) {

            if ($parentUrl == ''){
                unset($this->listing[1]['index.php']);
            }

            ?><ul class="<?= "parent_ul"; ?>">

            <?php

            foreach( $this->listing[1] as $folder ) {

                if ( $folder['childs_values'] ) {
                    ?>
                    <li class="have_child data-search" data-file-name="<?= $folder['filename']?>" >
                        <a
                                href="?acces=<?= $folder['acces']?>&acces_serveur=<?= $folder['serveur_acces']?>"
                                title="Open Folder"
                        >
                            <img alt="" src="<?= $folder['icone']?>">
                            <?= $folder['filename']?>
                        </a>
                        <a
                                class="LocalClipBoard"
                                data-clip="<?= $folder['acces']?>"
                        >
                            <?php

                            if ( strlen($folder['acces']) > 50 ) {

                                echo substr($folder['acces'],0,50)."...";

                            } else {

                                echo $folder['acces'];

                            }

                            ?>
                        </a>
                    </li>
                    <?php

                } else {

                    if($folder['is_file']) {

                        ?>
                        <li class="data-search" data-file-name="<?= $folder['filename']?>" >
                            <a

                                    class="file"
                                    href="<?= $folder['serveur_acces'] ?>"
                                    title="Open File"
                                    target="_blank"
                            >
                                <img alt="" src="<?= $folder['icone']?>">
                                <?= $folder['filename'] ?>
                            </a>

                            <a
                                    class="LocalClipBoard"
                                    data-clip="<?= $folder['acces']?>">
                                <?php

                                if ( strlen($folder['acces']) > 50 ) {

                                    echo substr($folder['acces'],0,50)."...";

                                } else {

                                    echo $folder['acces'];

                                }

                                ?>
                            </a>
                        </li>
                        <?php
                    }

                }

            }
            ?> </ul> <?php
        } else {
            ?><h4>Pas de fichier</h4><?php
        }

    }

    public function listing_file($acces,$server_url,$notIncludeArray = []) : array {
        if(is_dir($acces)) { // SI ON PARCOURS PAS UN FICHIER Ex : .php

            $scan = scandir($acces); // SCAN FOLDER
            $array_return=[];

            if($scan) {

                foreach($scan as $fichier) { // RUN FOLDER

                    if( !str_starts_with($fichier, ".") && !in_array($fichier,$notIncludeArray) ) {
                        $childs_values = false;

                        if(is_dir($acces.$fichier)) {

                            $is_file = false;
                            $acces_file_name = $fichier."/";
                            $icone_acces = $this->support_file['folder'];

                            if($this->AllListing) {
                                $childs_values = $this->listing_file(
                                    $acces.$acces_file_name,
                                    $server_url.$acces_file_name,
                                    $notIncludeArray
                                )[1];

                            } else {

                                $childs_values = true;

                            }


                        } else {

                            $is_file = true;
                            $acces_file_name = $fichier;
                            $icone_acces = $this->get_icone_acces($fichier);

                        }

                        // ADD VALUE
                        $array_return[$fichier] = array(
                                "filename"        => $fichier,
                                "parent_acces"    => $acces,
                                "acces"           => $acces.$acces_file_name,
                                "serveur_acces"   => $server_url.$acces_file_name,
                                "is_file"         => $is_file,
                                "childs_values"   => $childs_values,
                                "icone"           => $icone_acces,
                            );

                    }

                }

                return array(true,$array_return);

            } else {

                return array(false);

            }

        } else {

            return array(false);

        }

    }

    private function get_extension($the_file) : string {
        $extension = explode('.',$the_file);
        return end($extension);

    }

    private function get_icone_acces($file) : string|bool  {

        if(is_string($file)) {

            $file_extension = $this->get_extension($file);

            if( array_key_exists($file_extension,$this->support_file) ) {

                return $this->support_file[$file_extension];

            } else {

                return $this->support_file["default"];

            }

        }

        return false;

    }

}