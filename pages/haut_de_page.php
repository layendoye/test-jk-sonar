<?php 
session_start();
if(!isset($_GET['title'])) require("class/Autoloader.php"); else require("../class/Autoloader.php");
Autoloader::register();
Bdd::connexion('Universite','localhost','root','101419');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" <?php if(!isset($_GET['title'])) echo'href="css/table.css"'; else echo 'href="../css/table.css"'; ?>>
    <link rel="stylesheet" <?php if(!isset($_GET['title'])) echo'href="css/bootstrap.min.css"'; else echo 'href="../css/bootstrap.min.css"'; ?>>
    <link rel="stylesheet" <?php if(!isset($_GET['title'])) echo'href="css/circle.css"'; else echo 'href="../css/circle.css"'; ?>>
    <link rel="stylesheet" <?php if(!isset($_GET['title'])) echo'href="css/moncss.css"'; else echo 'href="../css/moncss.css"'; ?>>
    <title><?php if(!isset($_GET['title'])) echo'Accueil'; else echo $_GET['title']; ?></title>
    </head>
