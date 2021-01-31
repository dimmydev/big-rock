<?php

function dohvatiProizvode(){
    global $konekcija;
    $proizvodi = $konekcija->query("SELECT * FROM proizvod")->fetchAll();
    return $proizvodi;
}
function dohvatiProizvod($id)
{
    global $konekcija;
    $proizvod = $konekcija->query("SELECT * FROM proizvod WHERE id_proizvod = $id")->fetch();
    return $proizvod;
}
function radSaSlikom($slikaNaziv, $slikaTmp, $slikaTip, $slikaVelicina, $dimenzijeSirina, $dimenzijevisina, $izbor )
{
    $greske = [];

    $dozvoljeniTipovi = ['image/jpeg', 'image/jpg', 'image/png'];

    $regAlkohol = "/^([1-9][0-9]?)(\.\d)?$/";


    if (!in_array($slikaTip, $dozvoljeniTipovi)) {
        array_push($greske, "Tip fajla nije odgovarajući.");
    }
    if ($slikaVelicina > 2*1024*1024) {
        array_push($greske, "Veličina fajla nije odgovarajuća.");
    }

    if (count($greske) == 0) {

        $dimenzije = getimagesize($slikaTmp);
        $sirina = $dimenzije[0];
        $visina = $dimenzije[1];

        $postojecaSlika = null;
        switch ($slikaTip) {
            case 'image/jpeg':
                $postojecaSlika = imagecreatefromjpeg($slikaTmp);
                break;
            case 'image/png':
                $postojecaSlika = imagecreatefrompng($slikaTmp);
                break;
        }

        $novaSirina = $dimenzijeSirina;
        $novaVisina = $dimenzijevisina;

        $novaSlika = imagecreatetruecolor($novaSirina, $novaVisina);

        //Transparentnost

        imagesavealpha($novaSlika, true);
        $color = imagecolorallocatealpha($novaSlika, 0, 0, 0, 127);
        imagefill($novaSlika, 0, 0, $color);

        //

        imagecopyresampled($novaSlika, $postojecaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);

        if($izbor=="velika")

        $nazivSlike = time() . $slikaNaziv;

        elseif($izbor=="mala")

            $nazivSlike = "mala_" . time() . $slikaNaziv;

        switch ($slikaTip) {
            case 'image/jpeg':
                imagejpeg($novaSlika, "../../assets/images/beers/" . $nazivSlike);
                break;
            case 'image/png':
                imagepng($novaSlika, "../../assets/images/beers/" . $nazivSlike);
                break;
        }

        imagedestroy($postojecaSlika);
        imagedestroy($novaSlika);
        return $nazivSlike;
    }
    else
        return false;
}
