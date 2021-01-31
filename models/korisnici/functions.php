<?php

function dohvatiKorisnikaPoUsername($username){
    global $konekcija;

    $upit = "SELECT * FROM korisnik WHERE username=?";
    $priprema = $konekcija->prepare($upit);
    $priprema->execute([$username]);
    if($priprema->rowCount()==0)
        return false;
    else
        return $priprema->fetch();


}

function brojUlogovanih(){
    global $konekcija;

    $upit=$konekcija->query("SELECT COUNT(*) AS broj FROM korisnik WHERE ulogovan=1")->fetch();
    $broj=$upit->broj;
    return $broj;

}
