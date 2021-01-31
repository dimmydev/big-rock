<div class="container-fluid filter">
    <div class="row">
        <?php

        if(isset($_GET['proizvod'])){
        $idProizvod=$_GET['proizvod'];

        $upit="SELECT * FROM proizvod WHERE id_proizvod=$idProizvod";
        $rezultat=$konekcija->query($upit)->fetch();
        ?>
            <input type="hidden" value="<?= $idProizvod ?>" class="proizvodOcena" />
        <div class="col-md-5 slikaZasebno" >
            <div class="slikaOriginal">
                <img width="600" height="600" class="img-responsive" src="assets/images/beers/<?= $rezultat->slika ?>">
            </div>
        </div>
        <div class="col-md-5 opisZasebno" >
            <h1 class="nazivPivaZasebno"><?= $rezultat->naziv_proizvoda ?></h1>
            <p class="opisPivaZasebno"><?= $rezultat->opis ?></p>
            <p class="naslovZasebno">ALCOHOL</p>
            <p class="tekst"><?= $rezultat->alkohol ?>%</p>
            <p class="naslovZasebno">BEER STORY</p>
            <p class="tekst"><?= $rezultat->beer_story ?></p>

            <?php
            if(isset($_SESSION['korisnik'])){ ?>
                <div class="rate">
                    <p class="naslovZasebno">RATE</p><br/>
                    <div>
                        <i class="fa fa-star fa-4x" data-id="0"></i>
                        <i class="fa fa-star fa-4x" data-id="1"></i>
                        <i class="fa fa-star fa-4x" data-id="2"></i>
                        <i class="fa fa-star fa-4x" data-id="3"></i>
                        <i class="fa fa-star fa-4x" data-id="4"></i>
                    </div>
                    <br/>
                    <div class="prosek"></div>
                </div>
            <?php
             } else {

             }
            ?>
        </div>
        <?php } else { ?>
        <div class="col-md-2 kolona">
            <a href="models/proizvodi/exportExcel.php" class="btn btn-danger">Preuzmi podatke o proizvodima u Excel formatu</a>
            <input type="text" class="trazi" placeholder="Search"/>
            <div class="panel panel-default">
                <h2 class="filterNaziv">Styles</h2>
                <?php
                require_once "models/functions.php";
                $podaci=dohvati('kategorija');
                foreach($podaci as $podatak): ?>
                    <label class="containerr"><?= $podatak->naziv_kategorije ?>
                    <input type="radio" name="radioKategorija" class="radioKategorija" value="<?= $podatak->id_kategorija ?>" />
                    <span class="checkmark"></span>
                </label>
                <?php endforeach;?>
            </div>
            <div class="panel panel-default">
                <h2 class="filterNaziv">Sort</h2>
                <label class="containerr">Name  >
                    <input type="radio" name="radioSort" class="radioSort" value="1"/>
                    <span class="checkmark"></span>
                </label>
                <label class="containerr"><  Name
                    <input type="radio" name="radioSort" class="radioSort" value="2"/>
                    <span class="checkmark"></span>
                </label>
                <label class="containerr">Alcohol  >
                    <input type="radio" name="radioSort" class="radioSort" value="3"/>
                    <span class="checkmark"></span>
                </label>
                <label class="containerr"><  Alcohol
                    <input type="radio" name="radioSort" class="radioSort" value="4"/>
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
        <div class="col-md-10 prikazPiva">
            <p class="kategorija">All beers</p>
            <div class="nema text-center"></div>
            <div class="row text-center jedanProizvod" >

                <?php
                require_once "models/stranicenje/functions.php";
                $podaci=dohvatiPoStranici(3);
                foreach ($podaci as $podatak):
                ?>
                <div class="col-md-4 slikaMalaDiv">
                    <a href="index.php?page=allbeers&proizvod=<?= $podatak ->id_proizvod?>"><img src="assets/images/beers/<?= $podatak->mala_slika ?>"  width="330" height="330" alt="<?= $podatak->naziv_proizvoda ?>"></a>
                    <p class="nazivPiva"><?= $podatak->naziv_proizvoda ?></p>
                    <p class="abv">Alcohol: <?= $podatak->alkohol ?> %</p>
                    <p class="opisPiva"><?= $podatak->opis ?></p>
                </div>
                <?php endforeach; ?>

            </div>
            <div class="col-sm-3 brojeviPaginacija">
                <nav aria-label="...">
                    <ul class="pagination">
                        <?php
                        $brojLinkova=brojLinkova(3);
                        for($i=0; $i<$brojLinkova; $i++):
                            $index=$i+1;
                        ?>
                        <li class="page-item">
                            <a id="<?= $i?>" data-id="<?= $index?>" class="page-link stranicenjeBroj" href="#"><?= $index?></a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
