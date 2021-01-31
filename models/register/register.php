<?php

if(isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
    require_once "../../config/connection.php";
    require_once "functions.php";

    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $kriptovaniPassword=md5($password);
    $email=$_POST['email'];
    $datum=time();

    $regImePrezime="/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,25}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,25})*$/";
    $regUsername="/^[A-z0-9]{5,}$/";
    $regPassword="/^[A-z0-9]{5,}$/";

    $greske=[];

    if(!$ime){
        array_push($greske, "Polje za ime je obavezno!");
    }
    elseif(!preg_match($regImePrezime, $ime)){
        array_push($greske, "Polje za ime nije dobro popunjeno");
    }

    if(!$prezime){
        array_push($greske, "Polje za prezime je obavezno!");
    }
    elseif(!preg_match($regImePrezime, $prezime)){
        array_push($greske, "Polje za prezime nije dobro popunjeno");
    }

    if(!$username){
        array_push($greske, "Polje za username je obavezno!");
    }
    elseif(!preg_match($regUsername, $username)){
        array_push($greske, "Polje za username nije dobro popunjeno");
    }

    if(!$password){
        array_push($greske, "Polje za lozinku je obavezno!");
    }
    elseif(!preg_match($regPassword, $password)){
        array_push($greske, "Polje za lozinku nije dobro popunjeno");
    }

    if(!$email){
        array_push($greske, "Polje za email je obavezno!");
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($greske, "Email nije dobar");
    }

    if(count($greske)==0){

        $rezultat=proveriKorisnik($username, $email);

        if($rezultat->rowCount()==0){
            $upit="INSERT INTO korisnik VALUES('', ?, ?, ?, ?, ?, ?, 2, 0)";
            $priprema=$konekcija->prepare($upit);

            try{
                $rezultat=$priprema->execute([$ime, $prezime, $username, $kriptovaniPassword, $email, $datum]);
                response(201, "");
            }
            catch (PDOException $exception){
                response(500, $exception->getMessage());
            }
        }
        else{
            response(409, "Username ili email vec postoje.");
        }
    }
    else{
        response(422, "");
    }
}
else{
    response(404, "");
}

?>