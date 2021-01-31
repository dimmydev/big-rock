<?php

header("Content-Type: application/json");
include "../../config/connection.php";
if(isset($_POST['value'])){
    $value=trim($_POST['value']);
    $vrednost="%$value%";

    try{
        $upit=$konekcija->prepare("SELECT * FROM proizvod WHERE naziv_proizvoda LIKE ? OR opis LIKE ? OR beer_story LIKE ?");
        $upit->execute([$vrednost, $vrednost, $vrednost]);

        $podaci=$upit->fetchAll();
        echo json_encode($podaci);
        response(200, "");
    }
    catch (PDOException $exception){
        response(500, $exception->getMessage());
    }
}
else{
    response(400, "");
}