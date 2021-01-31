<?php
header("Content-Type: application/json");
include "../../config/connection.php";
if(isset($_POST['id'])){
    $id=$_POST['id'];
    $upit="SELECT * FROM proizvod p INNER JOIN kategorija k ON p.id_kategorija=k.id_kategorija WHERE id_proizvod=?";
    $priprema=$konekcija->prepare($upit);
    $priprema->execute([$id]);
    $rezultat=$priprema->fetch();

    echo json_encode($rezultat);
}
