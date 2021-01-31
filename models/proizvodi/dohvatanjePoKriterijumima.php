<?php
header("Content-type: application/json");
require_once "../../config/connection.php";
if(isset($_POST['ok'])) {
    $pretraga= $_POST['pretraga'];
    $sort = isset($_POST['sort']) ? $_POST['sort'] : 1;
    $stranica = $_POST['stranica'];

    $upitDodatak = [];
    $upitKraj = [];

    $upit = "SELECT * FROM proizvod p INNER JOIN kategorija k on p.id_kategorija = k.id_kategorija";

    if($pretraga)
        array_push($upitDodatak, " p.naziv_proizvoda LIKE '%$pretraga%' ");

    if(isset($_POST['kategorija'])) {

        $kategorija= $_POST['kategorija'];
        array_push($upitDodatak," p.id_kategorija=$kategorija ");
    }

    if($sort == 1)
        array_push($upitKraj, " ORDER BY p.naziv_proizvoda ASC ");
    else if ($sort == 2)
        array_push($upitKraj, " ORDER BY p.naziv_proizvoda DESC ");
    else if ($sort == 3)
        array_push($upitKraj, " ORDER BY p.alkohol ASC ");
    else if ($sort == 4)
        array_push($upitKraj, " ORDER BY p.alkohol DESC ");

    $stranica = ($stranica-1) * 3;

    array_push($upitKraj, " LIMIT $stranica ,3");

    if(count($upitDodatak)) {
        $upit .= " WHERE ";
        $upit .= implode(" AND ", $upitDodatak);
    }

    $broj = $konekcija->query($upit);
    $broj = $broj->rowCount();

    $upit .= implode($upitKraj);

    try{
        $podaci = $konekcija->query($upit)->fetchAll();
        echo json_encode([ "proizvodi"=> $podaci, "broj"=> $broj ]);
        response(200, "");
    }
    catch (PDOException $exception) {
        response(500, $exception->getMessage());
    }
}
else
    response(403, "");