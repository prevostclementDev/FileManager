<?php

class RepertoireListingAdvenced extends RepertoireListing {

    private array $notIncludeArray = array(
        'node_modules',
        'vendor'
    );
    private string $howSearch = '';
    private ?string $accesSearch = null;
    private ?string $accesServerSearch  = null;

    public function __construct($notIncludeArray = false){
        parent::__construct(true);

        if($notIncludeArray &&  is_array($notIncludeArray)) {
            $this->notIncludeArray = $notIncludeArray;
        }

        if( isset($_GET['search_advenced']) && is_string($_GET['search_advenced'] ) ) {

            $this->accesSearch = $_GET['acces'];
            $this->accesServerSearch = $_GET['acces_serveur'];
            $this->howSearch = $_GET['search_advenced'];

        }

    }

    public function jsonFormatListing() : void {
        $listing = $this->listing_file($this->accesSearch,$this->accesServerSearch,$this->notIncludeArray);
        echo json_encode(
            $this->listing_advenced(
                ($listing[0]) ? $listing[1] : array()
            )
        );
    }

    public function jsonFormatError($message) : string {
        return json_encode(array(
            "status" => false,
            "message" => $message
        ));
    }

    public function sendApi() : bool {
        if( $this->accesSearch ) {
            return true;
        } else {
            return false;
        }
    }

    private function listing_advenced(array $searchList) : array{
        $advencedListing=[];

        foreach($searchList as $key => $folder) {

            if( str_contains(strtolower($folder['filename']),strtolower($this->howSearch)) !== false ) {

                $advencedListing[] =
                    array(

                        "filename" => $folder['filename'],
                        "parent_acces" => $folder["parent_acces"],
                        "acces" => $folder["acces" ],
                        "serveur_acces" => $folder["serveur_acces"],
                        "is_file" => $folder["is_file"],
                        "childs_values" => false,
                        "icone" => $folder["icone"],

                    );

            }
            if ( $folder['childs_values'] || !empty($folder["childs_values"]) ) {
                foreach($this->listing_advenced($folder['childs_values']) as $value ) {
                    $advencedListing[] = $value;
                }
            }

        }
        return $advencedListing;
    }

}