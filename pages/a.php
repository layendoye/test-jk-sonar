<?php
require("../class/Autoloader.php");
Autoloader::register();
Bdd::connexion('Universite','localhost','root','101419');
for($a=0;$a<300;$a++){
$nom=array("Dieme","Ndoye","Thiam","Ly","Nzale","Seck","Diouf","Sall","ndour","fall","Gueye","Guaye","Mboup","Gadiaga","Pouye","Mbaye","Ly","Ndiaye","Mané","Sarr","Gomiss","Mbacke");
$prenom=array("Abdoulaye","Abdou","Amy","Sokhna","Khadi","Khadija","Astou","Kader","Souleymane","Djiamyl","Cheikh","Elemine","Ibou","Alpha","Yaya","Sadikh","Babacar");
$adresse=array("Nord foire","Parcelle","Ouest-foire","Mbao","Pikine","Sac");
$i=rand(0,(count($nom)-1));
$j=rand(0,(count($prenom)-1));
$k=rand(0,(count($adresse)-1));
$email=$nom[$i].$prenom[$j]."@gmail.com";
$jour=rand(1,27);
if ($jour<10) $jour="0".$jour;
$mois=rand(1,12);
if ($mois<10) $mois="0".$mois;
$annee=rand(85,99);
$tel=intval("77".rand(1000000,9999999));

$naiss="19".$annee."-".$mois."-".$jour;
$z=rand(1,3);

if($z==1){
    $adress=$adresse[$k];
    $etudiant=new Non_Boursiers('',$nom[$i],$prenom[$j], $naiss, $email, $tel, $adress );
    //die(var_dump($etudiant,'Non_Boursiers'));
}
    
if($z==2){
    $typrand=rand(0,1);
    $libell=array('Bourse complète','Bourse complète');
    $etudiant=new Boursiers('',$nom[$i],$prenom[$j], $naiss, $email, $tel,$libell[$typrand]);
    //die(var_dump($etudiant,'boursiers'));
}
    
if($z==3){
    $typrand=rand(0,1);
    $libell=array('Bourse complète','Bourse complète');
    $ch=rand(12,19);
    $etudiant=new Loges('',$nom[$i],$prenom[$j], $naiss, $email, $tel, $libell[$typrand],$ch);
    //die(var_dump($etudiant,'Loges'));
}

//EtudiantService::add($etudiant);
}