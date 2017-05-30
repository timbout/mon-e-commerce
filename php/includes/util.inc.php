<?php

function echop($str) {
    echo '<p>'.$str.'</p>';
}

function isFormatAllowed ($format){
    $isAllowed = False;

    //formats de fichier autorisés
    $formats_allowed = ['.png', '.jpg', '.gif'];

    foreach ($formats_allowed as $format_allowed) {
        if ($format_allowed == $format) {
            $isAllowed = true;
        }
    }
    return $isAllowed;
}


function rightFormat ($str) {
    $newFormat= '';
    // suprimme les espaces avant et apres
    $newFormat = trim($str);
    // passage en minuscule
    $newFormat= strtolower($newFormat);
    // remplace l'espace par un tiret
    $newFormat = str_replace(' ', '-', $newFormat);


    return $newFormat;
}





?>