<?php

define("APSOLUTNA_PUTANJA", $_SERVER["DOCUMENT_ROOT"]."/bigRock");
define("ENV_FAJL", APSOLUTNA_PUTANJA."/config/.env");
define("LOG_FAJL", APSOLUTNA_PUTANJA."/data/log.txt");
define("ERROR_FAJL", APSOLUTNA_PUTANJA."/data/error.txt");

define("BAZA", env("BAZA"));
define("SERVER", env("SERVER"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($naziv){
    $podaci=file(ENV_FAJL);
    $vrednost="";

    foreach ($podaci as $podatak) {
        $konfig=explode("=", $podatak);

        if($konfig[0]==$naziv){
            $vrednost=trim($konfig[1]);
        }
    }

    return $vrednost;
}

?>


