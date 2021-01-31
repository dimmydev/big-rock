<?php
session_start();
require_once "config/connection.php";

include "views/fixed/head.php";
include "views/fixed/header.php";

if(isset($_GET["page"])){
    $page=$_GET["page"];

    switch($page){
        case "home":
            include "views/pocetna.php";
            break;
        case "allbeers":
            include "views/beers.php";
            break;
        case "register":
            include "views/register.php";
            break;
        case "login":
            include "views/login.php";
            break;
        case "aboutme":
            include "views/oMeni.php";
            break;
        case "403_404":
            include "views/403_404.php";
            break;
        case "404_404":
            include "views/403_404.php";
            break;
        default:
            include "views/pocetna.php";
            break;
    }
}
else{
    include "views/pocetna.php";
}

include "views/fixed/footer.php";
?>