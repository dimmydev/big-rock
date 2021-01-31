<?php
if(!isset($_SESSION['korisnik'])){ ?>
    <div class="login">
    <div class="registracijaTekst">
        <h2>Log in</h2>
    </div>
    <div class="registracijaForma">
        <form>
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" onblur="proveriUsername()">
                <h4 class="regularniFalse">Please, enter a valid username with minimum 5 characters.</h4>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" onblur="proveriPassword()">
                <h4 class="regularniFalse">Please, enter a valid password with minimum 5 characters.</h4>
            </div>
            <input type="button" class="btn btn-outline-primary " value="Submit" id="ulogujSe" name="ulogujSe"/>
        </form>
        <p class="already">Not registered? <a class="registerLoginLink" href="index.php?page=register">Register here</a> </p>
    </div>
</div>
<?php }
else{ ?>
<div class="registracija">
    <div class="registracijaTekst">
        <h2 class="obavestenjeLoginRegister">Već ste ulogovani</h2>
    </div>
</div>
<?php } ?>

