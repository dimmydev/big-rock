<nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light">
    <a href="index.php" class="navbar-brand">
        <img src="assets/images/logo.png" class="logo" alt="Logo" width="50" height="50"/><img src="assets/images/logo-text-white.png" alt="Logo"/>
    </a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
    <ul class="navbar-nav">
    <?php
                require_once "models/meni/functions.php";
                if(isset($_SESSION['korisnik'])){
                    $podaci=dohvatiMeni(1, $_SESSION['korisnik']->id_uloga);
                }
                else{
                    $podaci=dohvatiMeni(1, 3);
                }

                foreach ($podaci as $podatak): ?>
                    <li class="nav-item headerLink"><a href="<?= $podatak->putanja ?>" class="nav-link"><?= $podatak->naziv ?></a></li>
                <?php endforeach; ?>
    </ul>
    </div>   
</nav>
