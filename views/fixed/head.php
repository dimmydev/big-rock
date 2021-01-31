<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    <title>
        <?php
        if(isset($_GET["page"])){
            $page=$_GET["page"];

            switch ($page){
                case "home":
                    echo "Home";
                    break;
                case "allbeers":
                    echo "Our beers";
                    break;
                case "register":
                    echo "Register";
                    break;
                case "login":
                    echo "Login";
                    break;
                case "aboutme":
                    echo "About me";
                    break;
                default:
                    echo "Home";
                    break;
            }
        }
        else{
            echo "Home";
        }
        ?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
