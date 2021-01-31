<?php
header("Content-Type: application/json");
include "../../config/connection.php";
    $upit="SELECT * FROM korisnik k INNER JOIN uloga u ON k.id_uloga=u.id_uloga";
    try{
        $rezultat=$konekcija->query($upit)->fetchAll();
        echo json_encode($rezultat);
        response(200, "");
    }
    catch (PDOException $exception){
        echo json_encode($exception->getMessage());
        response(500, $exception->getMessage());
    }

