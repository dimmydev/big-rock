<?php
session_start();
include "config/connection.php";
include "views/fixed/head.php";
include "views/fixed/header.php";
if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->id_uloga==1) { ?>
        <?php
        $ispis="";
        $ispis="<div class='red'>";
            if(isset($_GET['poruka'])) echo $_GET['poruka'];
        $ispis="</div>";?>
</div>
<div class="cistac"></div> -->

<div class="container-fluid admin">
    <div class="brojUlogovanih">
        <?php
        include "models/korisnici/functions.php";
        $broj=brojUlogovanih();
        echo "Broj ulogovanih korisnika: $broj";
        ?>
    </div><br/>
    <h2>Admin Panel</h2>
    <form class="adminForma">
  <select class="custom-select my-1 mr-sm-2 ddLista">
    <option selected>Izaberite...</option>
    <option value="korisnici">Korisnici</option>
    <option value="proizvodi">Proizvodi</option>
    <option value="ocene">Ocene piva</option>
  </select>

  <input type="button" class="btn my-1 dugmeAdmin" value="Prikaži"/>
</form>
<div class="ispis">
    <h2>Pristup stranicama (u procentima)</h2>
    <?php
    include "models/admin/pristupSajtu.php";
    ?>
</div><br/><br/><br/><br/><br/><br/>
<div class="ispis2">

</div>
<!--    <a href="models/admin/pristupSajtu.php" class="btn btn-danger">Pristup sajtu</a>-->
</div>
<?php }
else{
    include "views/403_404.php";
} include "views/fixed/footer.php";?>