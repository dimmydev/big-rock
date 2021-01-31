<?php

include "../../config/connection.php";
if(isset($_POST['id']) && isset($_POST['uloga'])){
    $id=$_POST['id'];
    $uloga=$_POST['uloga'];

    $upit="UPDATE korisnik SET id_uloga=? WHERE id_korisnik=?";
    $priprema=$konekcija->prepare($upit);
    try{
        $priprema->execute([$uloga, $id]);
        response(204, "");
    }
    catch (PDOException $exception){
        echo json_encode($exception->getMessage());
        response(500, $exception->getMessage());
    }
}
else{
    response(400, "");
}