<?php

// Début connexion base de données
$pdo = Database::connect();
// Fin connexion BDD

// Début variables 
define('NOM_SITE', "Toys'4'Us", false);
define('LOGO_SITE', 'images/logo.png', false);
// Fin variables

// Les Fonctions
require_once("fonctions-panier.php");

function deco()
{
    session_destroy();
    session_unset();
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 1000);
            setcookie($name, '', time() - 1000, '/');
        }
    }
}

function verifAge($naissance, $age = 18)
{
    if (is_string($naissance)) {
        $naissance = strtotime($naissance);
    }
    // 31 536 000 = 1 année en secondes
    if (time() - $naissance < $age * 31536000) {
        return false;
    }
    return true;
}

function securite($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function cacheCreditCard()
{
    $str = "1111 2222 3333 5444";
    //$str = $_POST[$data];
    $last_four = substr($str, 15, 4);
    return "XXXX XXXX XXXX $last_four";
}

function cryptMdp($data)
{
    $data = sha1(md5($data)) . '_CrYpTo';
    return $data;
}

function titreDesPages($data)
{
    switch ($data) {
        case "accueil":
            $titlepage = "Accueil";
            break;

        case "pageguide":
            $titlepage = "Fonctionnement du site";
            break;
            // FAIRE LA SUITE 

        default:
            $titlepage = null;
    }

    if (!empty($titlepage)) {
        echo $titlepage . " - ";
    }
    echo NOM_SITE;
}
// Fin Fonctions
