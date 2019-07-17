<?php
    
    class Bdd{
        private static $nom_bdd;
        private static $serveur;
        private static $Monlogin;
        private static $Monpass;

        public static function connexion($nom_bdd,$serveur = "localhost",$Monlogin = "root",$Monpass = "101419"){//comme ca les 3 autres elements seront facultatives
            self::$nom_bdd=$nom_bdd;
            self::$serveur=$serveur;
            self::$Monlogin=$Monlogin;
            self::$Monpass=$Monpass;
        }
        
        public static function getPDO(){
            $connexion = new PDO("mysql:host=".self::$serveur.";dbname=".self::$nom_bdd.";charset=utf8", self::$Monlogin, self::$Monpass); //se connecte au serveur mysquel
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //setAttribute — Configure l'attribut PDO $connexion
            return $connexion;
        }
        
        public static function recuperation($le_codemysql){
            $requete = self::getPDO()->prepare($le_codemysql); //Prépare la requête $codemysql à l'exécution
            $requete->execute();
            $donnee=$requete->fetchAll(PDO::FETCH_OBJ);
            
            return $donnee;
        }
    }
    