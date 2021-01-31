<?php
header("Content-Type: application/json");
include "../../config/connection.php";
$upit="SELECT * from uloga";
$rezultat=$konekcija->query($upit)->fetchAll();

echo json_encode($rezultat);
