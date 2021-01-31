<?php

session_start();
require_once "../../config/connection.php";
require_once "../korisnici/functions.php";

$id=$_SESSION['korisnik']->id_korisnik;
$upit=$konekcija->query("UPDATE korisnik SET ulogovan=0 WHERE id_korisnik=$id");
response(204, "");

unset($_SESSION['korisnik']);
header("Location: ../../index.php");

?>