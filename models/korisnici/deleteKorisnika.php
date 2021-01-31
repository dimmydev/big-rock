<?php
include "../../config/connection.php";
if(isset($_POST['id'])){
    $id=$_POST['id'];

    try{
        $upit="DELETE FROM korisnik WHERE id_korisnik=?";
        $priprema=$konekcija->prepare($upit);
        $priprema->execute([$id]);

        response(204, "");
    }
    catch (PDOException $e){
        response(500, $e->getMessage());
    }
}
else{
    response(400, "");
}