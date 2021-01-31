<?php

function dohvatiPoStranici($brojPoStranici){
    global $konekcija;

    $upit ="SELECT * FROM proizvod LIMIT 0, $brojPoStranici";
    $rezultat = $konekcija->query($upit)->fetchAll();

    return $rezultat;
}

function brojLinkova($brojPoStranici){
    global $konekcija;

    $upit="SELECT COUNT(*) AS broj FROM proizvod";
    $brojProizvoda=$konekcija->query($upit)->fetch();
    $brojLinkova=ceil($brojProizvoda->broj/$brojPoStranici);

    return $brojLinkova;
}

?>
