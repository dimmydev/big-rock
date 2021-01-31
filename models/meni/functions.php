<?php

function dohvatiMeni($pozicija, $uloga){
    global $konekcija;

    $upit="SELECT * FROM meni m INNER JOIN meni_uloga mu ON m.id_meni=mu.id_meni WHERE m.id_pozicija_meni=:pozicija AND mu.id_uloga=:uloga ORDER BY redosled";
    $priprema=$konekcija->prepare($upit);
    $priprema->bindParam(":pozicija", $pozicija);
    $priprema->bindParam(":uloga", $uloga);
    $priprema->execute();
    $rezultat=$priprema->fetchAll();

    return $rezultat;
}