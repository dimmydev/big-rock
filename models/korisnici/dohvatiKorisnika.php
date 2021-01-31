<?php
header("Content-Type: application/json");
include "../../config/connection.php";
if(isset($_POST['id'])){
    $id=$_POST['id'];
    $upit="SELECT * FROM korisnik k INNER JOIN uloga u ON k.id_uloga=u.id_uloga WHERE id_korisnik=?";
    $priprema=$konekcija->prepare($upit);
    $priprema->execute([$id]);
    $rezultat=$priprema->fetch();

    echo json_encode($rezultat);
}