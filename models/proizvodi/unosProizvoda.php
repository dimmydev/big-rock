<?php
//define("FILE_SIZE", 2*1024*1024); //2MB
if(isset($_POST['unosProizvodaDugme'])){
    include "../../config/connection.php";
    include "functions.php";

    $slika=$_FILES['slikaUnos'];
    $slikaVelicina=$slika['size'];
    $slikaTip=$slika['type'];
    $slikaTmp=$slika['tmp_name'];
    $slikaNaziv=$slika['name'];

    $putanjaMalaSlika=radSaSlikom($slikaNaziv, $slikaTmp, $slikaTip, $slikaVelicina, 330, 330, "mala");
    $putanjaVelikaSlika=radSaSlikom($slikaNaziv, $slikaTmp, $slikaTip, $slikaVelicina, 600, 600, "velika");



    $naziv=$_POST['nazivPro'];
    $opis=$_POST['opisUnos'];
    $beerStory=$_POST['beerStoryUnos'];
    $alkohol=$_POST['alkoholUnos'];
    $kategorija=$_POST['kategorijaIzbor'];

    $errors=[];

    $regAlkohol="/^([1-9][0-9]?)(\.\d)?$/";

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


    if(count($errors)==0){
        if($putanjaMalaSlika && $putanjaVelikaSlika){
            $upit=$konekcija->prepare("INSERT INTO proizvod (naziv_proizvoda, opis, beer_story, slika, mala_slika, alkohol, id_kategorija) VALUES (?, ?, ?, ?, ?, ?, ?)");

            try {
                $rezultat = $upit->execute([$naziv, $opis, $beerStory, $putanjaVelikaSlika, $putanjaMalaSlika, $alkohol, $kategorija]);
                header("Location: ../../admin.php");


            } catch(PDOException $ex){
                echo $ex->getMessage();
            }
        }
    }
    else{
        foreach ($errors as $error)
            echo $error;
    }

} else {

    }

