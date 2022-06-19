<?php
    /* #################### */
    /* DISPLAY LIST OF FILE */
    /* #################### */
    function display_listing($folder_list,$AllListing) {

        ?> 
        
            <ul class="<?= "parent_ul"; ?>"> 
            
        <?php

        foreach( $folder_list as $folder ) {
            
                    if ( $folder['childs_values'] != false ) {
                        ?>  
                            <li class="have_child data-search" data-file-name="<?= $folder['filename']?>" >  
                                <a 
                                    href="?acces=<?= $folder['acces']?>&acces_serveur=<?= $folder['serveur_acces']?>" 
                                    alt="Open Folder"
                                    >
                                        <img src="<?= $folder['icone']?>">
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
                                alt="Open File"
                                target="_blank"
                                >
                                    <img src="<?= $folder['icone']?>">
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
    }


    