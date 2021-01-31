<?php
header("Content-Type: applicatioin/json");

require_once "../../config/connection.php";

    if(isset($_POST['broj']))
    {
        $kategorija = $_POST['kategorija'];
        $x = $_POST['broj'];
        $x = $x*3;

        $upit = "SELECT * FROM proizvod LIMIT 3 OFFSET $x";
        $podaci = $konekcija->query($upit)->fetchAll();

        echo json_encode($podaci);
    }