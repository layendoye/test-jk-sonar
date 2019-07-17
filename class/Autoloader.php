<?php
Class Autoloader{
    static function register(){//pour ne pas avoir de probleme si on utilise à nouveau un autoloader
        spl_autoload_register(array(__CLASS__,'autoload'));//__CLASS__ renvoi le nom de la classe
    }
    static function autoload($nom_class){//charge automatiquement la classe utilisée
        $nom_class=str_replace(__NAMESPACE__.'\\','',$nom_class);//vu que l'autoloader et les classes ont le meme nom de namespace il cherchera directement le nom de la classe sans le namespace donc on peut enlever le AN\ exemple AN\Form sera Form... __NAMESPACE__ renvoi le nom du namespace AN\
        require __DIR__.'/'.$nom_class.'.php';//__DIR__ renvoie le chemin du dossier dans lequel se trouve le fichier
    }
}