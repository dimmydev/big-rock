<?php

if(isset($_POST['izmenaProizvodaDugme'])) {
    include '../../config/connection.php';
    include 'functions.php';

    $id = $_POST['updateDeleteId'];

    $naziv = $_POST['nazivPro'];
    $opis = $_POST['opisUnos'];
    $beerStory = $_POST['beerStoryUnos'];
    $alkohol = $_POST['alkoholUnos'];
    $kategorija = $_POST['kategorijaIzbor'];

    $errors = [];

    $regAlkohol = "/^([1-9][0-9]?)(\.\d)?$/";

    if(strlen($naziv)==0 || strlen($naziv)>50){
        array_push($errors, "Morate upisati naziv i on ne sme biti veći od 50 karaktera.");
    }
    if(strlen($opis)==0){
        array_push($errors, "Morate upisati opis.");
    }
    if(strlen($beerStory)==0){
        array_push($errors, "Morate upisati beer story.");
    }
    if(!preg_match($regAlkohol, $alkohol)){
        array_push($errors, "Alkohol morate uneti kao ceo broj ili kao decimalni broj sa jednim mestom nakon tacke! Primer: 5 ili 5.3");
    }
    if($kategorija=="Izaberite..."){
        array_push($errors, "Morate izabrati kategoriju.");
    }

    if (empty($_FILES['slikaUnos']['name'])) {
        if (count($errors) == 0) {
            try {
                $upit = $konekcija->prepare("UPDATE proizvod SET naziv_proizvoda = ?, opis = ?, beer_story = ?, alkohol = ?, id_kategorija = ? WHERE id_proizvod = ?");

                if($upit->execute([$naziv, $opis, $beerStory, $alkohol, $kategorija, $id]))
                    header("Location: ../../admin.php");
                else
                    header("Location: ../../index.php");
            } catch (PDOException $ex) {

                echo $ex->getMessage();
            }
        }
        else
            echo "d";
    } else {
        $slika = $_FILES['slikaUnos'];
        $slikaVelicina = $slika['size'];
        $slikaTip = $slika['type'];
        $slikaTmp = $slika['tmp_name'];
        $slikaNaziv = $slika['name'];

        $putanjaMalaSlika = radSaSlikom($slikaNaziv, $slikaTmp, $slikaTip, $slikaVelicina, 330, 330, "mala");
        $putanjaVelikaSlika = radSaSlikom($slikaNaziv, $slikaTmp, $slikaTip, $slikaVelicina, 600, 600, "velika");

        if (count($errors) == 0) {
            if ($putanjaMalaSlika && $putanjaVelikaSlika) {
                $upit = $konekcija->prepare("UPDATE proizvod SET naziv_proizvoda=?, opis=?, beer_story=?, slika=?, mala_slika=?, alkohol=?, id_kategorija=? WHERE id_proizvod=?");
                try {
                    $rezultat = $upit->execute([$naziv, $opis, $beerStory, $putanjaVelikaSlika, $putanjaMalaSlika, $alkohol, $kategorija, $id]);

                    header("Location: ../../admin.php");
                } catch (PDOException $ex) {
                    header ("Location: ../../index.php");
                }
            }
        }
    }
}else{
    header("Location: index.php");
}