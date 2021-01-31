<?php
if(!isset($_SESSION['korisnik'])){ ?>
<div class="registracija container-fluid">
    <div class="registracijaTekst">
        <h2>Become a Big Rocker</h2>
        <p>Get insider scoop on exclusive events,<br/>new beers and much more</p>
    </div>
    <div class="registracijaForma">
        <form>
            <div class="form-group">
                <input type="text" class="form-control" id="ime" name="ime" placeholder="First Name" onblur="proveriIme()">
                <h4 class="regularniFalse">Please, enter a valid first name with minimum 3 letters which first is capital letter.</h4>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Last Name" onblur="proveriPrezime()">
                <h4 class="regularniFalse">Please, enter a valid last name with minimum 3 letters which first is capital letter.</h4>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" onblur="proveriUsername()">
                <h4 class="regularniFalse">Please, enter a valid username with minimum 5 characters.</h4>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" onblur="proveriPassword()">
                <h4 class="regularniFalse">Please, enter a valid password with minimum 5 characters.</h4>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" onblur="proveriEmail()">
                <h4 class="regularniFalse">Please, enter a valid email address.</h4>
            </div>
            <input type="button" class="btn btn-outline-primary " value="Submit" id="registrujSe" name="registrujSe"/>
        </form>
        <!-- Modal Dobro-->
        <div class="modal fade" id="myModalDobro" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="zatvori" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Congratulations!</h3>
                    </div>
                    <div class="modal-body">
                        <p>You have successfully registered. Now you can log in with your username and password.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="zatvori" class="btn btn-default" data-dismiss="modal">Log in</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Lose-->
        <div class="modal fade" id="myModalLose" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Oooops!</h3>
                    </div>
                    <div class="modal-body">
                        <p>Username or email already exists. Try another one.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <p class="already">Already registered? <a class="registerLoginLink" href="index.php?page=login">Log in here</a> </p>
    </div>
</div>
<?php }
else{ ?>
    <div class="registracija">
        <div class="registracijaTekst">
            <h2 class="obavestenjeLoginRegister">Već ste registrovani</h2>
        </div>
    </div>
<?php } ?>