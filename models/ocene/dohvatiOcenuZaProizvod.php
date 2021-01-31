<?php
session_start();
header("Content-Type: application/json");
include "../../config/connection.php";

if(isset($_POST['idProizvod'])){
    $idProizvod=$_POST['idProizvod'];
    $idKorisnik=$_SESSION['korisnik']->id_korisnik;

    try{
        $upit=$konekcija->prepare("SELECT * FROM korisnik_proizvod WHERE id_korisnik=? AND id_proizvod=?");
        $upit->execute([$idKorisnik, $idProizvod]);
        $podatak=$upit->fetch();

        $upit2=$konekcija->prepare("SELECT AVG(ocena) AS prosek FROM korisnik_proizvod WHERE id_proizvod=?");
        $upit2->execute([$idProizvod]);
        $prosek=$upit2->fetch();
        echo json_encode([ "podatak"=> $podatak, "prosek"=> $prosek ]);
        response(200, "");
    }
    catch(PDOException $exception){
        response(500, $exception->getMessage());
    }
}
else{
http_response_code(400);
}

