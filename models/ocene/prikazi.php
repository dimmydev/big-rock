<?php
header("Content-Type: application/json");
include "../../config/connection.php";

$upit="SELECT * FROM korisnik k INNER JOIN korisnik_proizvod kp ON k.id_korisnik=kp.id_korisnik INNER JOIN proizvod p ON kp.id_proizvod=p.id_proizvod";
try{
    $rezultat=$konekcija->query($upit)->fetchAll();
    echo json_encode($rezultat);
    response(200, "");
}
catch (PDOException $exception){
    echo json_encode($exception->getMessage());
    response(500, $exception->getMessage());
}


