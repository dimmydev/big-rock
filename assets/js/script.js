let rateId=-1;

$(document).ready(function(){    
    $(".headerLink").hover(
        function(){
            $(this).addClass('pozadina');
        },
        function(){
            $(this).removeClass('pozadina');
        }
    )

    $(document).on("click", "#registrujSe", function(){
        let ime=$("#ime").val();
        let prezime=$("#prezime").val();
        let username=$("#username").val();
        let password=$("#password").val();
        let email=$("#email").val();

        let greske = [];

        let regImePrezime = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,25}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,25})*$/;
        let regUsername = /^[A-z0-9]{5,}$/;
        let regPassword = /^[A-z0-9]{5,}$/;
        let regEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!regImePrezime.test(ime)) {
            greske.push("Ime nije u odgovarajućem formatu");
        }
        if (!regImePrezime.test(prezime)) {
            greske.push("Prezime nije u odgovarajućem formatu");
        }
        if (!regUsername.test(username)) {
            greske.push("Korisničko ime nije u odgovarajućem formatu");
        }
        if (!regPassword.test(password)) {
            greske.push("Lozinka nije u odgovarajućem formatu");
        }
        if (!regEmail.test(email)) {
            greske.push("E-mail nije u odgovarajućem formatu");
        }

        if (greske.length == 0){
            $.ajax({
                url: "models/register/register.php",
                method: "post",
                data:{
                    ime:ime,
                    prezime:prezime,
                    username:username,
                    password:password,
                    email:email,
                },
                success: function(){
                    $("#myModalDobro").modal();
                    $(".modal-title").css("color", "green");
                },
                error: function(podaci) {
                    switch (podaci.status) {
                        case 409:
                            $("#myModalLose").modal();
                            $(".modal-title").css("color", "red");
                            break;
                        case 422:
                            alert("Invalid data");
                            break;
                        case 500:
                            alert("Server error");
                            break;
                    }
                }
            });
        }
        else{
            alert("Data are not in good format!");
        }
    });

    $(document).on("click", "#zatvori", function(){
        window.location="index.php?page=login";
    });

    $(document).on("click", "#ulogujSe", function(){
        var username=$("#username").val();
        var password=$("#password").val();

        var greske = [];

        var regUsername = /^[A-z0-9]{5,}$/;
        var regPassword = /^[A-z0-9]{5,}$/;

        if (!regUsername.test(username)) {
            greske.push("Korisničko ime nije u odgovarajućem formatu");
        }
        if (!regPassword.test(password)) {
            greske.push("Lozinka nije u odgovarajućem formatu");
        }

        if (greske.length == 0){
            $.ajax({
                url: "models/login/login.php",
                method: "post",
                data:{
                    username:username,
                    password:password
                },
                success: function(){
                    window.location="index.php";
                },
                error: function(podaci) {
                    switch (podaci.status) {
                        case 422:
                            alert("Invalid data.");
                            break;
                        case 404:
                            alert("User not found. Try again.");
                            break;
                        case 409:
                            alert("Wrong password! Try again.");
                            break;
                    }
                }
            });
        }
        else{
            alert("Data are not in good format!");
        }
    });

    $(document).on("click", ".dugmeAdmin", function(e){
        e.preventDefault();

        var izabranaOpcija=$(".ddLista").val();
        prikazAdmin(izabranaOpcija);
    });

    $(document).on("click", ".izmeniKorisnika", function(){
        let id=$(this).data("id");

        $.ajax({
            url: "models/korisnici/dohvatiKorisnika.php",
            method: "post",
            dataType: "json",
            data:{
                id: id
            },
            success: function(podatak){
                $.ajax({
                    url: "models/korisnici/dohvatiUlogu.php",
                    method: "post",
                    dataType: "json",
                    success: function(podaci){
                        let ispis=`<h2>Izmeni korisnika</h2><form>
                        <div class="form-group">
                          <label for="ime">Ime</label>
                          <input type="text" class="form-control" id="ime" value="${podatak.ime}" readonly/>
                        </div>
                        <div class="form-group">
                          <label for="prezimeime">Prezime</label>
                          <input type="text" class="form-control" id="prezime" value="${podatak.prezime}" readonly/>
                        </div>
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control" id="username" value="${podatak.username}" readonly/>
                        </div>`;

                        ispis+=`<label for="uloga">Uloga</label>
                        <select class="form-control ulogaDdl" id="uloga">`;

                        let selektovano="";
                        for(let podatak2 of podaci){
                        if(podatak.id_uloga==podatak2.id_uloga)
                            selektovano="selected";
                        else
                            selektovano="";

                            ispis+=`<option ${selektovano} value="${podatak2.id_uloga}">${podatak2.naziv}</option>`;
                        }
                        ispis+=`</select>`;
                        ispis+=`<button type="button" data-id="${podatak.id_korisnik}" class="btn updateKorisnika">Izmeni</button>
                        </form>`;
                        $(".ispis").html(ispis);
                    }
                });
            }
        });
    });

    $(document).on("click", ".updateKorisnika", function(){

        let id=$(this).data("id");
        let uloga=$('#uloga').val();

        $.ajax({
            url: "models/korisnici/updateKorisnika.php",
            method: "post",
            data:{
                id:id,
                uloga:uloga
            },
            success: function(){
                alert("You have successfully updated the user!");
            }
        });
    });

    $(document).on("click", ".obrisiKorisnika", function(){

        if(confirm("Do you really want to delete this user?")){
            let id=$(this).data("id");

            $.ajax({
                url: "models/korisnici/deleteKorisnika.php",
                method: "post",
                data:{
                    id:id
                },
                success: function(){
                    $.ajax({
                        url: "models/korisnici/prikaziKorisnike.php",
                        method: "post",
                        dataType: "json",
                        success: function(podaci){
                            ispisiKorisnike(podaci);
                        }
                    });
                }
            });
        }
    });

    $(document).on("click", ".obrisiProizvod", function(){

        if(confirm("Do you really want to delete this product?")){
            let id=$(this).data("id");

            $.ajax({
                url: "models/proizvodi/deleteProizvoda.php",
                method: "post",
                data:{
                    id:id
                },
                success: function(){
                    $.ajax({
                        url: "models/proizvodi/prikazi.php",
                        method: "post",
                        dataType: "json",
                        success: function(podaci){
                            ispisiProizvode(podaci);
                        }
                    });
                }
            });
        }
    });

    $(document).on("keyup", ".trazi", function(){
        dohvatanjePoKriterijumima(1);
    });

    $(document).on("click", ".radioKategorija", function(){
        dohvatanjePoKriterijumima(1);
    });

    $(document).on("click", ".radioSort", function(){
        dohvatanjePoKriterijumima(1);
    });

    $(document).on("click",".stranicenjeBroj", function (e) {
        e.preventDefault();
        dohvatanjePoKriterijumima($(this).data("id"));
    });

    $(document).on("click", ".izmeniProizvod", function(){
        let id=$(this).data("id");

        $.ajax({
            url: "models/proizvodi/dohvatiProizvod.php",
            method: "post",
            dataType: "json",
            data:{
                id: id
            },
            success: function(podatak){
                $.ajax({
                    url: "models/proizvodi/dohvatiKategorije.php",
                    method: "post",
                    dataType: "json",
                    success: function(podaci){
                        let ispis=`<h2>Izmeni proizvod</h2><form enctype="multipart/form-data" method="post" onsubmit="return proveraProizvodIzmena()" action="models/proizvodi/izmenaProizvoda.php">>
                        <div class="form-group">
                          <label for="nazivPro">Naziv proizvoda</label>
                          <input type="text" class="form-control" id="nazivPro" name="nazivPro" value="${podatak.naziv_proizvoda}" />
                        </div>
                        <div class="form-group">
                          <label for="opisUnos">Opis</label><br/>
                          <textarea class='text' name='opisUnos' id='opisUnos'>${podatak.opis}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="beerStoryUnos">Beer story</label><br/>
                          <textarea class='text' name='beerStoryUnos' id='beerStoryUnos'>${podatak.beer_story}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="dugme">Slika</label></br>
                          <button type="button" id="dugme" onclick="document.getElementById('slikaUnos').click()" class="btn btn-info">Dodaj sliku</button>
                          <span id="profilePhotoValue"></span>
                          <input type="file" name="slikaUnos" id="slikaUnos" style="display:none;" onchange="document.getElementById('profilePhotoValue').innerHTML=this.value;"/>
                        </div>
                        <div class="form-group">
                          <label for="alkoholUnos">Alkohol</label>
                          <input type="text" class="form-control" id="alkoholUnos" name="alkoholUnos" value="${podatak.alkohol}" />
                        </div>
                        <input type="hidden"  value="${podatak.id_proizvod}" name="updateDeleteId"/>`;

                        ispis+=`<label for="kategorija">Kategorija</label>
                        <select class="form-control" id="kategorijaIzbor" name="kategorijaIzbor">`;
                        let selektovano="";
                        for(let podatak2 of podaci){
                            if(podatak.id_kategorija==podatak2.id_kategorija)
                                selektovano="selected";
                            else
                                selektovano="";

                            ispis+=`<option ${selektovano} value="${podatak2.id_kategorija}">${podatak2.naziv_kategorije}</option>`;
                        }
                        ispis+=`</select>`;
                        ispis+=`<button type="submit" name="izmenaProizvodaDugme" class="btn">Izmeni</button>
                        </form>
                        <div class="greskeIspis"></div>`;
                        $(".ispis").html(ispis);
                        $(".ispis2").html("");
                    }
                });
            }
        });
    });

    //rating stars
    resetujBojeZvezde();
    proizvodKorisnikGlas();

    $('.fa-star').on("click", function () {
        rateId=parseInt($(this).data('id'));
        let idProizvod=$('.proizvodOcena').val();

        $.ajax({
            url: "models/ocene/insertUpdateOcene.php",
            method: "post",
            data:{
                ocena: rateId,
                idProizvod: idProizvod
            },
            success:function (podaci, status, xhr) {
                switch (xhr.status){
                    case 201:
                        alert("You have successfully voted!");
                        break;
                    case 204:
                        alert("You have successfully updated your vote!");
                        break;
                }
                proizvodKorisnikGlas();
            },
            error: function(){
            }
        })
    })

    $('.fa-star').mouseover(function(){
        resetujBojeZvezde();

        let trenutniId=parseInt($(this).data('id'));

        setujZvezdice(trenutniId);
    });

    $('.fa-star').mouseleave(function(){
        resetujBojeZvezde();

        if(rateId!=-1){
            setujZvezdice(rateId);
        }
    })
});

function setujZvezdice(max){
    for(let i=0; i<=max; i++){
        $('.fa-star:eq('+i+')').css("color", "#df8800");
    }
}

function resetujBojeZvezde(){
    $('.fa-star').css('color', "#212529");
}

function prikazProizvodi(id, kategorija) {
    $.ajax({
        url: "models/stranicenje/dohvatanjeProizvoda.php",
        type: "post",
        data: {
            broj: id,
            kategorija: kategorija
        },
        dataType: "json",
        success: function (podaci) {
            var ispis = "";
            for (var podatak of podaci) {
                ispis += `<div class="col-md-4 slikaMalaDiv">
                    <a href="index.php?page=allbeers&proizvod=${podatak.id_proizvod}"><img src="assets/images/beers/${podatak.slika}"  width="330" height="330" alt="${podatak.naziv_proizvoda}"></a>
                    <p class="nazivPiva">${podatak.naziv_proizvoda}</p>
                    <p class="abv">ABV: ${podatak.alkohol} %</p>
                    <p class="opisPiva">${podatak.opis}</p>
                    </div>`;

                $(".jedanProizvod").html(ispis);
            }
        },
        error: function (xhr, status, error) {
            alert(xhr.status);
        }
    });
}

function prikazAdmin(opcija){
    $.ajax({
        url: "models/"+opcija+"/prikazi.php",
        method: "post",
        dataType: "json",
        success: function(podaci){
            if(opcija=="korisnici"){
                ispisiKorisnike(podaci);
            }
            else if(opcija=="proizvodi"){
                formaZaUnosProizvoda();
                ispisiProizvode(podaci);
            }
            else if(opcija=="ocene"){
                ispisiOcene(podaci);
            }
        }
    });
}

function ispisiKorisnike(podaci){
    let brojac=1;
    let ispis=`<table class="table table-striped">
                            <thead class="tabelaHeader">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ime</th>
                                <th scope="col">Prezime</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Email</th>
                                <th scope="col">Datum registracije</th>
                                <th scope="col">Uloga</th>
                                <th scope="col">Izmena</th>
                                <th scope="col">Brisanje</th>
                                </tr>
                            </thead>
                            <tbody>`;
    for(let podatak of podaci ){
        let myDate = new Date( podatak.datum_registracije *1000);
        let mytime=myDate.toGMTString();
        ispis+=`<tr>
                        <th scope="row">${brojac}</th>
                        <td>${podatak.ime}</td>
                        <td>${podatak.prezime}</td>
                        <td>${podatak.username}</td>
                        <td>${podatak.password}</td>
                        <td>${podatak.email}</td>
                        <td>${mytime}</td>
                        <td>${podatak.naziv}</td>
                        <td><button type="button" class="btn izmeniKorisnika" data-id="${podatak.id_korisnik}">Izmeni</button></td>
                        <td><button type="button" class="btn obrisiKorisnika" data-id="${podatak.id_korisnik}">Obriši</button></td>
                </tr>`;
        brojac++;
    }
    ispis+=`</tbody></table>`;
    $(".ispis").html(ispis);
    $(".ispis2").html("");
}

function ispisiProizvode(podaci) {
    let brojac=1;
    let ispis=`<table class="table table-striped">
                            <thead class="tabelaHeader">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Naziv</th>
                                <th scope="col">Opis</th>
                                <th scope="col">Beer Story</th>
                                <th scope="col">Slika</th>
                                <th scope="col">Alkohol</th>
                                <th scope="col">Kategorija</th>
                                <th scope="col">Izmena</th>
                                <th scope="col">Brisanje</th>
                                </tr>
                            </thead>
                            <tbody>`;
    for(let podatak of podaci ){
        ispis+=`<tr>
                        <th scope="row">${brojac}</th>
                        <td>${podatak.naziv_proizvoda}</td>
                        <td>${podatak.opis}</td>
                        <td>${podatak.beer_story}</td>
                        <td><img src="assets/images/beers/${podatak.mala_slika}" width="150" height="150" alt="${podatak.naziv_proizvoda}"/></td>
                        <td>${podatak.alkohol}</td>
                        <td>${podatak.naziv_kategorije}</td>
                        <td><button type="button" class="btn izmeniProizvod" data-id="${podatak.id_proizvod}">Izmeni</button></td>
                        <td><button type="button" class="btn obrisiProizvod" data-id="${podatak.id_proizvod}">Obriši</button></td>
                </tr>`;
        brojac++;
    }
    ispis+=`</tbody></table>`;
    $(".ispis2").html(ispis);
}

function ispisiOcene(podaci){
    let brojac=1;
    let ispis=`<table class="table table-striped">
                            <thead class="tabelaHeader">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ime i prezime</th>                               
                                <th scope="col">Username</th>
                                <th scope="col">Proizvod</th>
                                <th scope="col">Slika</th>
                                <th scope="col">Ocena</th>                            
                                </tr>
                            </thead>
                            <tbody>`;
    for(let podatak of podaci ){
        ispis+=`<tr>
                        <th scope="row">${brojac}</th>
                        <td>${podatak.ime} ${podatak.prezime}</td>
                        <td>${podatak.username}</td>
                        <td>${podatak.naziv_proizvoda}</td>
                        <td><img src="assets/images/beers/${podatak.mala_slika}" width="150" height="150" alt="${podatak.naziv_proizvoda}"/></td>
                        <td>${podatak.ocena}</td>                       
                </tr>`;
        brojac++;
    }
    ispis+=`</tbody></table>`;
    $(".ispis").html(ispis);
    $(".ispis2").html("");
}

function formaZaUnosProizvoda(){
    $.ajax({
        url: "models/proizvodi/dohvatiKategorije.php",
        method: "post",
        dataType: "json",
        success: function(podaci){
            let ispis=`<h2>Unesi proizvod</h2><form enctype="multipart/form-data" method="post" onsubmit="return proveraProizvod()" action="models/proizvodi/unosProizvoda.php">
                        <div class="form-group">
                          <label for="nazivPro">Naziv proizvoda</label>
                          <input type="text" class="form-control" id="nazivPro" name="nazivPro"/>
                        </div>
                        <div class="form-group">
                          <label for="opisUnos">Opis</label><br/>
                          <textarea class='text' name='opisUnos' id='opisUnos'></textarea>
                        </div>
                        <div class="form-group">
                          <label for="beerStoryUnos">Beer story</label><br/>
                          <textarea class='text' name='beerStoryUnos' id='beerStoryUnos'></textarea>
                        </div>
                        <div class="form-group">
                          <label for="dugme">Slika</label></br>
                          <button type="button" id="dugme" onclick="document.getElementById('slikaUnos').click()" class="btn btn-info">Dodaj sliku</button>
                          <span id="profilePhotoValue"></span>
                          <input type="file" name="slikaUnos" id="slikaUnos" style="display:none;" onchange="document.getElementById('profilePhotoValue').innerHTML=this.value;"/>
                        </div>
                        <div class="form-group">
                          <label for="alkoholUnos">Alkohol</label>
                          <input type="text" class="form-control" id="alkoholUnos" name="alkoholUnos"/>
                        </div>
                        <div class="form-group">
                          <label for="kategorijaIzbor">Kategorija</label>
                          <select class="form-control" id="kategorijaIzbor" name="kategorijaIzbor"><option selected>Izaberite...</option>`;
                          for(let podatak of podaci){
                              ispis+=`<option value=${podatak.id_kategorija}>${podatak.naziv_kategorije}</option>`;
                          }
                        ispis+=`</select>
                        </div>`;

            ispis+=`<button type="submit"  name="unosProizvodaDugme" class="btn">Unesi proizvod</button>
                        </form>
<div class="greskeIspis"></div>`;
            $(".ispis").html(ispis);
        }
    })

}

function proveraProizvod(){
    let naziv = $("#nazivPro").val();
    let opis = $("#opisUnos").val();
    let beerStory=$("#beerStoryUnos").val();
    let alkohol=$("#alkoholUnos").val();
    let kategorija=$( "#kategorijaIzbor option:selected" ).val();
    let slika=$("#slikaUnos").val();

    let nizGreske=[];

    let regAlkohol=/^([1-9][0-9]?)(\.\d)?$/;

    if(naziv.length==0 || naziv.length>50){
        nizGreske.push("Morate upisati naziv i on ne sme biti veći od 50 karaktera.");
    }
    if(opis.length==0){
        nizGreske.push("Morate upisati opis.");
    }
    if(beerStory.length==0){
        nizGreske.push("Morate upisati beer story.");
    }
    if(!regAlkohol.test(alkohol)){
        nizGreske.push("Vrednost u polje alkohol morate uneti kao ceo broj ili kao decimalan broj sa jednim mestom nakon tačke! Primer: 5 ili 5.3");
    }
    if(kategorija=="Izaberite..."){
        nizGreske.push("Morate izabrati kategoriju");
    }
    if(!slika){
        nizGreske.push("Morate izabrati sliku.");
    }
    if(nizGreske.length!=0){
        let ispis="<ul>";
        for(let greska of nizGreske){
            ispis+="<li>"+greska+"</li>";
        }
        ispis+="</ul>";
        $('.greskeIspis').html(ispis);
        return false;
    }
    else{
        return true;
    }
}

function proveraProizvodIzmena(){
    let naziv = $("#nazivPro").val();
    let opis = $("#opisUnos").val();
    let beerStory=$("#beerStoryUnos").val();
    let alkohol=$("#alkoholUnos").val();
    let kategorija=$( "#kategorijaIzbor option:selected" ).val();
    let slika=$("#slikaUnos").val();

    let nizGreske=[];

    let regAlkohol=/^([1-9][0-9]?)(\.\d)?$/;

    if(naziv.length==0 || naziv.length>50){
        nizGreske.push("Morate upisati naziv i on ne sme biti veći od 50 karaktera.");
    }
    if(opis.length==0){
        nizGreske.push("Morate upisati opis.");
    }
    if(beerStory.length==0){
        nizGreske.push("Morate upisati beer story.");
    }
    if(!regAlkohol.test(alkohol)){
        nizGreske.push("Vrednost u polje alkohol morate uneti kao ceo broj ili kao decimalan broj sa jednim mestom nakon tačke! Primer: 5 ili 5.3");
    }
    if(kategorija=="Izaberite..."){
        nizGreske.push("Morate izabrati kategoriju");
    }
    if(nizGreske.length!=0){
        let ispis="<ul>";
        for(let greska of nizGreske){
            ispis+="<li>"+greska+"</li>";
        }
        ispis+="</ul>";
        $('.greskeIspis').html(ispis);
        return false;
    }
    else{
        return true;
    }
}

function dohvatanjePoKriterijumima(stranica) {
    let pretraga = $(".trazi").val();
    let kategorija = $('input[name=radioKategorija]:checked').val();
    switch (kategorija) {
        case "1": $('.kategorija').html("Signature");
         break;
        case "2": $('.kategorija').html("Seasonal");
            break;
        case "3": $('.kategorija').html("Lambic Style");
            break;
        case "4": $('.kategorija').html("Cider");
            break;
        case "5": $('.kategorija').html("AGD");
            break;
    }
    let sort = $('input[name=radioSort]:checked').val();

    $.ajax({
        url: "models/proizvodi/dohvatanjePoKriterijumima.php",
        method: "POST",
        data: {
            pretraga: pretraga,
            kategorija: kategorija,
            sort: sort,
            stranica: stranica,
            ok: true
        },
        dataType: "json",
        success: function (podaci) {
            proizvodiPoKriterijumima(podaci);
        },
        error: function (xhr) {
            console.log(xhr.status);
        }
    });
}

function proizvodiPoKriterijumima(podaci){
    let ispis="";
    let ispis2="";

    let proizvodi = podaci.proizvodi;

    let ispisStranica = "";

    if(proizvodi.length){
        for(let proizvod of proizvodi){
            ispis+=`<div class="col-md-4 slikaMalaDiv">
                    <a href="index.php?page=allbeers&proizvod=${proizvod.id_proizvod}"><img src="assets/images/beers/${proizvod.slika}"  width="330" height="330" alt="${proizvod.naziv_proizvoda}"></a>
                    <p class="nazivPiva">${proizvod.naziv_proizvoda}</p>
                    <p class="abv">ABV: ${proizvod.alkohol} %</p>
                    <p class="opisPiva">${proizvod.opis}</p>
                </div>`;
        }

        let brojProizvoda=podaci.broj;
        let brojStrana =Math.ceil(brojProizvoda/3);

        for (let i = 0; i < brojStrana; i++) {
            let index = i + 1;
            ispisStranica += `<li class="page-item">
                            <a id="${i}" data-id="${index}" class="page-link stranicenjeBroj" href="#">${index}</a>
                        </li>`;
        }
        if(brojStrana == 1){
            ispisStranica= "";
        }
    }

    else {
        ispis2 = "<h2>Sorry, your search did not match any products. Please try again.</h2>";
    }

    $(".jedanProizvod").html(ispis);
    $(".nema").html(ispis2);
    $(".pagination").html(ispisStranica);
}

function proizvodKorisnikGlas(){
    let idProizvod=$('.proizvodOcena').val();

    $.ajax({
        url: "models/ocene/dohvatiOcenuZaProizvod.php",
        method: "post",
        dataType: "json",
        data:{
            idProizvod: idProizvod
        },
        success:function(podaci){
            let podatak=podaci.podatak;
            let prosek=podaci.prosek;
            console.log(prosek);

            setujZvezdice(podatak.ocena-1);

            let ispis="AVERAGE RATING: "+prosek.prosek.substr(0, 3)+"/5";
            $(".prosek").html(ispis);

        }
    })
}

function proveriIme() {
    let ime = document.getElementById("ime").value;
    let regImePrezime = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,25}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,25})*$/;
    if (!regImePrezime.test(ime)) {
        document.getElementById("ime").style.border = "2px solid black";
        document.getElementById("ime").style.borderRadius = "initial";
        $("#ime")
            .next(".regularniFalse")
            .css("display", "block");
    } else {
        document.getElementById("ime").style.border = "2px solid #8b2219";
        document.getElementById("ime").style.borderRadius = "10px";
        $("#ime")
            .next(".regularniFalse")
            .css("display", "none");
    }
    if (ime == "") {
        document.getElementById("ime").style.borderColor = "initial";
        document.getElementById("ime").style.border = "1px solid #ced4da";
        document.getElementById("ime").style.borderRadius = ".25rem";
        $("#ime")
            .next(".regularniFalse")
            .css("display", "none");
    }
}

function proveriPrezime() {
    let prezime = document.getElementById("prezime").value;
    let regImePrezime = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,25}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,25})*$/;
    if (!regImePrezime.test(prezime)) {
        document.getElementById("prezime").style.border = "2px solid black";
        document.getElementById("prezime").style.borderRadius = "initial";
        $("#prezime")
            .next(".regularniFalse")
            .css("display", "block");
    } else {
        document.getElementById("prezime").style.border = "2px solid #8b2219";
        document.getElementById("prezime").style.borderRadius = "10px";
        $("#prezime")
            .next(".regularniFalse")
            .css("display", "none");
    }
    if (prezime == "") {
        document.getElementById("prezime").style.borderColor = "initial";
        document.getElementById("prezime").style.border = "1px solid #ced4da";
        document.getElementById("prezime").style.borderRadius = ".25rem";
        $("#prezime")
            .next(".regularniFalse")
            .css("display", "none");
    }
}

function proveriUsername() {
    let username = document.getElementById("username").value;
    let regUsername = /^[A-z0-9]{5,}$/;
    if (!regUsername.test(username)) {
        document.getElementById("username").style.border = "2px solid black";
        document.getElementById("username").style.borderRadius = "initial";
        $("#username")
            .next(".regularniFalse")
            .css("display", "block");
    } else {
        document.getElementById("username").style.border = "2px solid #8b2219";
        document.getElementById("username").style.borderRadius = "10px";
        $("#username")
            .next(".regularniFalse")
            .css("display", "none");
    }
    if (username == "") {
        document.getElementById("username").style.borderColor = "initial";
        document.getElementById("username").style.border = "1px solid #ced4da";
        document.getElementById("username").style.borderRadius = ".25rem";
        $("#username")
            .next(".regularniFalse")
            .css("display", "none");
    }
}

function proveriPassword() {
    let password = document.getElementById("password").value;
    let regPassword = /^[A-z0-9]{5,}$/;
    if (!regPassword.test(password)) {
        document.getElementById("password").style.border = "2px solid black";
        document.getElementById("password").style.borderRadius = "initial";
        $("#password")
            .next(".regularniFalse")
            .css("display", "block");
    } else {
        document.getElementById("password").style.border = "2px solid #8b2219";
        document.getElementById("password").style.borderRadius = "10px";
        $("#password")
            .next(".regularniFalse")
            .css("display", "none");
    }
    if (password == "") {
        document.getElementById("password").style.borderColor = "initial";
        document.getElementById("password").style.border = "1px solid #ced4da";
        document.getElementById("password").style.borderRadius = ".25rem";
        $("#password")
            .next(".regularniFalse")
            .css("display", "none");
    }
}

function proveriEmail() {
    let email = document.getElementById("email").value;
    let regEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!regEmail.test(email)) {
        document.getElementById("email").style.border = "2px solid black";
        document.getElementById("email").style.borderRadius = "initial";
        $("#email")
            .next(".regularniFalse")
            .css("display", "block");
    } else {
        document.getElementById("email").style.border = "2px solid #8b2219";
        document.getElementById("email").style.borderRadius = "10px";
        $("#email")
            .next(".regularniFalse")
            .css("display", "none");
    }
    if (email == "") {
        document.getElementById("email").style.borderColor = "initial";
        document.getElementById("email").style.border = "1px solid #ced4da";
        document.getElementById("email").style.borderRadius = ".25rem";
        $("#email")
            .next(".regularniFalse")
            .css("display", "none");
    }
}