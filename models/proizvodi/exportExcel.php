<?php
require_once "../../config/connection.php";
require_once "functions.php";

$proizvodi = dohvatiProizvode();

$excel = new COM("Excel.Application");

$excel->Visible = 1;

$workbook = $excel->Workbooks->Open("http://localhost/bigRock/data/proizvodi.xlsx") or die('Did not open filename');

$sheet = $workbook->Worksheets('Sheet1');
$sheet->activate;

$br = 1;
foreach($proizvodi as $proizvod){
    $polje = $sheet->Range("A{$br}");
    $polje->activate;
    $polje->value = $proizvod->id_proizvod;

    $polje = $sheet->Range("B{$br}");
    $polje->activate;
    $polje->value = $proizvod->naziv_proizvoda;

    $polje = $sheet->Range("C{$br}");
    $polje->activate;
    $polje->value = $proizvod->opis;

    $polje = $sheet->Range("D{$br}");
    $polje->activate;
    $polje->value = $proizvod->beer_story;

    $polje = $sheet->Range("E{$br}");
    $polje->activate;
    $polje->value = $proizvod->alkohol;

    $polje = $sheet->Range("F{$br}");
    $polje->activate;
    $polje->value = $proizvod->id_kategorija;


    $br++;
}

$workbook->_SaveAs("http://localhost/bigRock/data/proizvodi.xlsx", -4143);
$workbook->Save();

$workbook->Saved=true;
$workbook->Close;

$excel->Workbooks->Close();
$excel->Quit();

unset($sheet);
unset($workbook);
unset($excel);

?>
