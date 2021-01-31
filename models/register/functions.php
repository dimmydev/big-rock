<?php
function proveriKorisnik($username, $email){
    global $konekcija;

    $upit="SELECT * FROM korisnik WHERE username=? OR email=?";
    $priprema=$konekcija->prepare($upit);
    $priprema->execute([$username, $email]);

    return $priprema;
}
?>