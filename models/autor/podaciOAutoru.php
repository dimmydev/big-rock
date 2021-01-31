<?php include "../../config/connection.php";
include "functions.php";
$autor = dohvatiAutora();

$word = new COM("word.application", NULL, CP_UTF8) or die("Unable to instantiate Word object");
$word->Visible = true;
$word->Documents->Add();
$word->Selection->TypeText("$autor->ime $autor->prezime, $autor->indeks\n$autor->opis");
$word->ActiveDocument->SaveAs("oAutoru.doc");

header("Location: ../../index.php");
?>
