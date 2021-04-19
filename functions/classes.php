<?php

class Database
{
    private static $host = 'localhost';
    private static $db   = 'toys4us';
    private static $user = 'root';
    private static $pass = '';
    private static $charset = 'utf8';
    private static $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    private static $pdo = null;

    public function __construct()
    {
        die('Fonction Init non autorisée');
    }

    public static function connect()
    {
        // Autoriser une seule connexion pour toute la durée de l’accès
        if (null == self::$pdo) {
            try {
                self::$pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset, self::$user, self::$pass, self::$options);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int) $e->getCode());
            }
        }
        return self::$pdo;
    }

    public static function disconnect()
    {
        self::$pdo = null;
    }
}

class Utilisateur
{

    protected $_genre, $_prenom, $_nom, $_datenaissance, $_adresse, $_adressesup, $_codepostal, $_ville, $_telmobile, $_telfixe, $_rang, $_societe, $_siret, $_login;

    public function __construct($genre, $nom, $prenom, $datenaissance, $adresse, $adressesup, $codepostal, $ville, $telmobile, $telfixe, $rang, $societe, $siret, $login)
    {
        $this->_genre = $genre;
        $this->_nom = $nom;
        $this->_prenom = $prenom;
        $this->_datenaissance = $datenaissance;
        $this->_adresse = $adresse;
        $this->_adressesup = $adressesup;
        $this->_codepostal = $codepostal;
        $this->_ville = $ville;
        $this->_telmobile = $telmobile;
        $this->_telfixe = $telfixe;
        $this->_rang = $rang;
        $this->_societe = $societe;
        $this->_siret = $siret;
        $this->_login = $login;
    }

    // LECTURE
    public function getGenre()
    {
        return $this->_genre;
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function getPrenom()
    {
        return $this->_prenom;
    }

    public function getDateNaissance()
    {
        return $this->_datenaissance;
    }

    public function getAdresse()
    {
        return $this->_adresse;
    }

    public function getAdressesup()
    {
        return $this->_adressesup;
    }

    public function getCodePostal()
    {
        return $this->_codepostal;
    }

    public function getVille()
    {
        return $this->_ville;
    }

    public function getTelMobile()
    {
        return $this->_telmobile;
    }

    public function getTelFixe()
    {
        return $this->_telfixe;
    }

    public function getRang()
    {
        return $this->_rang;
    }

    public function getSociete()
    {
        return $this->_societe;
    }

    public function getSiret()
    {
        return $this->_siret;
    }

    public function getLogin()
    {
        return $this->_login;
    }

    // ECRITURE
    public function setGenre($genre)
    {
        $this->_genre = $genre;
    }

    public function setPrenom($prenom)
    {
        $this->_prenom = $prenom;
    }

    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    public function setDateNaissance($datenaissance)
    {
        $this->_datenaissance = $datenaissance;
    }

    public function setAdresse($adresse)
    {
        $this->_adresse = $adresse;
    }

    public function setAdressesup($adressesup)
    {
        $this->_adressesup = $adressesup;
    }

    public function setCodePostal($codepostal)
    {
        $this->_codepostal = $codepostal;
    }

    public function setVille($ville)
    {
        $this->_ville = $ville;
    }

    public function setTelMobile($telmobile)
    {
        $this->_telmobile = $telmobile;
    }

    public function setTelFixe($telfixe)
    {
        $this->_telfixe = $telfixe;
    }

    public function setRang($rang)
    {
        $this->_rang = $rang;
    }

    public function setSociete($societe)
    {
        $this->_societe = $societe;
    }

    public function setSiret($siret)
    {
        $this->_siret = $siret;
    }

    public function setLogin($login)
    {
        $this->_login = $login;
    }
}
