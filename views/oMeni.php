<div class="container-fluid filter text-center">
    <div class="row">
        <?php
        include_once "models/autor/functions.php";
        $autor=dohvatiAutora();
        ?>
        <div class="col-md-5 divSlika" >
            <img src="<?=$autor->slika ?>" width="400" height="400" alt="Moja slika">
        </div>
        <div class="col-md-7">
            <p id="pasusOMeni"><?= $autor->opis ?></p>
        </div>
    </div>
    <a href="models/autor/podaciOAutoru.php" class="btn btn-danger">Preuzmi podatke o autoru</a>
</div>