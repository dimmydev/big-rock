<?php
session_start();
include "../../config/connection.php";
include "functions.php";
if(isset($_POST['ocena']) && isset($_POST['idProizvod'])){
    $idKorisnik=$_SESSION['korisnik']->id_korisnik;
    $idProizvod=$_POST['idProizvod'];
    $ocena=$_POST['ocena']+1;

    $podatak=daLiJeGlasao($idKorisnik, $idProizvod);

    if($podatak){
        try{
            $upit=$konekcija->prepare("UPDATE korisnik_proizvod SET ocena=? WHERE id_korisnik_proizvod=$podatak->id_korisnik_proizvod");
            $rezultat=$upit->execute([$ocena]);

            response(204, "");
        }
        catch (PDOException $exception){
            response(500, $exception->getMessage());
        }
    }
    else{
        try{
            $upit=$konekcija->prepare("INSERT INTO korisnik_proizvod (id_korisnik, id_proizvod, ocena) VALUES (?, ?, ?)");
            $rezultat=$upit->execute([$idKorisnik, $idProizvod, $ocena]);

            response(201, "");
        }
        catch (PDOException $exception){
            response(500, $exception->getMessage());
        }
    }
}
else{
    response(400, "");
}
