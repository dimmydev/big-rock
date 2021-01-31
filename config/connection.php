<?php
include "config.php";

pristupStranicama();

try{
    $konekcija=new PDO("mysql:host=".SERVER."; dbname=".BAZA."; charset=utf8", USERNAME, PASSWORD );
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch (PDOException $exception){
    echo "Greška sa konekcijom: ".$exception->getMessage();
}

function pristupStranicama(){
    $file = fopen(LOG_FAJL, "a");
    $string = basename($_SERVER['REQUEST_URI']) . "\t" . date("d.m.Y H:i:s") . "\t" . $_SERVER['REMOTE_ADDR'] . "\n";
    fwrite($file, $string);
    fclose($file);
}

function response($code, $poruka){
    if($code >= 400){
        $file = fopen(ERROR_FAJL, "a");
        $string = basename($_SERVER['REQUEST_URI']) . "\t" . date("d.m.Y H:i:s") . "\t" . $_SERVER['REMOTE_ADDR'] . "\t" . $code . "\t" . $poruka. "\n";
        fwrite($file, $string);
        fclose($file);
    }
    http_response_code($code); }
?>

