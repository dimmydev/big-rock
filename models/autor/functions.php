<?php

function dohvatiAutora(){
    global $konekcija;

    $autor=$konekcija->query("SELECT * FROM autor")->fetch();

    return $autor;
}