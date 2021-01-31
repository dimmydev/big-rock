<?php

function dohvati($tabela){
    global $konekcija;
    $upit="SELECT * FROM $tabela";
    $rezultat=$konekcija->query($upit)->fetchAll();

    return $rezultat;
}
