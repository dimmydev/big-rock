<nav class="navbar navbar-expand-sm navbar-light bg-light" id="futerMeni">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
    <ul class="navbar-nav">
    <?php
                    require_once "models/functions.php";

                    if(isset($_SESSION['korisnik'])){
                        $podaci=dohvatiMeni(2, $_SESSION['korisnik']->id_uloga);
                    }
                    else{
                        $podaci=dohvatiMeni(2, 3);
                    }

                    foreach ($podaci as $podatak): ?>
                        <li class="nav-item"><a href="<?= $podatak->putanja ?>" class="nav-link"><?= $podatak->naziv ?></a></li>
                    <?php endforeach; ?>
    </ul>
    </div>
 </nav>

 <nav class="navbar navbar-expand-sm navbar-light bg-light" id="futerMeni">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
    <ul class="navbar-nav">
        <li class="social"><a href="https://www.facebook.com/BigRockBrewery" target="_blank" data-event="social" data-track-link="facebook"><img src="assets/images/facebook.png" alt="Facebook"></a> </li>
        <li class="social"><a href="https://www.instagram.com/bigrockbrewery/" target="_blank" data-event="social" data-track-link="facebook"><img src="assets/images/instagram.png" alt="Instagram"></a> </li>
        <li class="social"><a href="https://twitter.com/bigrockbrewery" target="_blank" data-event="social" data-track-link="facebook"><img src="assets/images/twitter.png" alt="Twitter"></a> </li>
    </ul>
    </div>
 </nav>
 <div class="copyrightDiv">
 <p class="est">EST. 1985</p><br/><br/>
 <p class="copyright">&copy;2019 Stefan Dimitrijević. Logo, name and pictures are property of Big Rock Brewery and they are used for educational purposes only.
 </p>
 </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="assets/js/script.js"></script>
</body>
</html>
