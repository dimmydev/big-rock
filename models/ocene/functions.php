<?php

function daLiJeGlasao($idKorisnik, $idProizvod){
    global $konekcija;
    $podatak=$konekcija->query("SELECT * FROM korisnik_proizvod WHERE id_korisnik=$idKorisnik AND id_proizvod=$idProizvod")->fetch();
    return $podatak;
}
