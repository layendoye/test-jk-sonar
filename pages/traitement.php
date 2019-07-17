<?php
session_start();
require("../class/Autoloader.php");
Autoloader::register();
Bdd::connexion('Universite','localhost','root','101419');
    try{
        if(isset($_POST['choix']) && $_POST['choix']=='Loger' && $_POST['Batiment']!='' && !isset($_POST['valider_ajout_etudiant']) && !isset($_POST['valider_modif_etudiant'])){
            $_SESSION['donnees_etudiants']=$_POST;
            if(isset($_SESSION['modif_actuel'])) header('location: etudiants.php?title=Etudiants&ChoiCh=true&'.$_SESSION['modif_actuel'].'&Statut_et=Loger');
            else header("location: etudiants.php?title=Etudiants&ChoiCh=true");
            
        }
        if(isset($_POST['valider_ajout_etudiant']) || isset($_POST['AnnulerEtu'])){
            if(isset($_POST['AnnulerEtu'])) {header("location: etudiants.php?title=Etudiants&annuler=true"); die();}
            if($_POST['choix']=='Boursier'){//un simple boursier
                $etudiant=new Boursiers('',$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['type_bour']);
            }
            elseif($_POST['choix']=='Loger'){//boursier et logé
                $nombreEtuCh=count(EtudiantService::find('Loges','id_Chambre','id_Chambre',$_POST['chambre']));
                
                if($nombreEtuCh<4)
                    $etudiant=new Loges('',$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['type_bour'],$_POST['chambre']);
                else{
                    $numero=EtudiantService::find('Chambres','Numero_Ch','id_Chambre',$_POST['chambre'])[0]->Numero_Ch;
                    header("location: etudiants.php?title=Etudiants&ChoiCh=true&Chpleine=".$numero);
                    die();//pour ne pas supprimer la variable $_SESSION
                }
            }
            elseif($_POST['choix']=='Non Boursier'){//non boursier{
                $etudiant=new Non_Boursiers('',$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['adresse']);
            }
            unset($_SESSION['donnees_etudiants']);
            EtudiantService::add($etudiant);
            $matricule=EtudiantService::find('Etudiants','Matricule');
            header("location: etudiants.php?title=Etudiants&popUp=".$matricule[count($matricule)-1]->Matricule);
        }
        if(isset($_POST['valider_modif_etudiant']) || isset($_POST['AnnulerEtu'])){
            if(isset($_POST['AnnulerEtu'])) {header("location: etudiants.php?title=Etudiants&annuler=true"); die();}
            if($_POST['choix']=='Boursier'){//un simple boursier
                $etudiant=new Boursiers($_GET['matricule_modif'],$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['type_bour']);
            }
            elseif($_POST['choix']=='Loger'){//boursier et logé
                $nombreEtuCh=count(EtudiantService::find('Loges','id_Chambre','id_Chambre',$_POST['chambre']));
                //die(var_dump(EtudiantService::find('Loges','id_Chambre','Matricule',$_GET['matricule_modif'])[0]->id_Chambre));
                if($nombreEtuCh<4 || $nombreEtuCh==4 && EtudiantService::find('Loges','id_Chambre','Matricule',$_GET['matricule_modif'])[0]->id_Chambre==$_POST['chambre'])
                    $etudiant=new Loges($_GET['matricule_modif'],$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['type_bour'],$_POST['chambre']);
                else{
                    $numero=EtudiantService::find('Chambres','Numero_Ch','id_Chambre',$_POST['chambre'])[0]->Numero_Ch;
                    header('location: etudiants.php?title=Etudiants&ChoiCh=true&'.$_SESSION['modif_actuel'].'&Statut_et=Loger&Chpleine='.$numero);
                    die();//pour ne pas supprimer la variable $_SESSION
                }
            }
            elseif($_POST['choix']=='Non Boursier'){//non boursier{
                $etudiant=new Non_Boursiers($_GET['matricule_modif'],$_POST['nom'],$_POST['prenom'], $_POST['naiss'], $_POST['email'], $_POST['tel'], $_POST['adresse']);
            }
            EtudiantService::update($etudiant);
            header("location: etudiants.php?title=Etudiants&popUp=".$_GET['matricule_modif']);
        }
        if(isset($_GET['matricule_sup'])){
            $matricule=$_GET['matricule_sup'];
            if(EtudiantService::find('Non_Boursiers','Matricule','Matricule',$matricule)!=null) EtudiantService::delete('Non_Boursiers','Matricule',$matricule);
            if(EtudiantService::find('Loges','Matricule','Matricule',$matricule)!=null) EtudiantService::delete('Loges','Matricule',$matricule);
            if(EtudiantService::find('Boursiers','Matricule','Matricule',$matricule)!=null) EtudiantService::delete('Boursiers','Matricule',$matricule);
            EtudiantService::delete('Etudiants','Matricule',$matricule);
            header("location: etudiants.php?title=Etudiants");
        }
        if(isset($_GET['id_Categ_Bourse_sup'])){
            $id_Categ=$_GET['id_Categ_Bourse_sup'];
            $dejaMigrer=false;
            if(EtudiantService::find('Boursiers','id_Categ_Bourse','id_Categ_Bourse',$id_Categ)!=null) $dejaMigrer=true;
            if($dejaMigrer==false){
                EtudiantService::delete('Categorie_Bourse','id_Categ_Bourse',$id_Categ);
                header("location: bourses.php?title=Bourses");
            }
            else{
                header("location: bourses.php?title=Bourses&dejaMigrer=true");
            }
        }
        if(isset($_POST['valider_ajout_bourse'])){
            $existe=false;
            if(EtudiantService::find('Categorie_Bourse','Libelle','Libelle',$_POST['Libelle'])!=null) $existe=true;
            if($existe==false){
                $categorie=new Categorie_Bourse('',$_POST['Libelle'],$_POST['Montant']);
                EtudiantService::addCategorie_Bourse($categorie);
                header("location: bourses.php?title=Bourses");
            }
            else{
                $_SESSION['donnees']=$_POST;
                header("location: bourses.php?title=Bourses&existe=true");
            }
        }
        if(isset($_POST['valider_mod_bourse'])){
             $existe=false;
            if($lib=EtudiantService::find('Categorie_Bourse','Libelle','Libelle',$_POST['Libelle'])[0]->Libelle){
                if(EtudiantService::find('Categorie_Bourse','Libelle','id_Categ_Bourse',$_SESSION['id_Categ_Bourse_mod'])[0]->Libelle!=$lib)
                $existe=true;
            }
            if($existe==false){
                $categorie=new Categorie_Bourse('',$_POST['Libelle'],$_POST['Montant']);
                EtudiantService::updateTable('Categorie_Bourse',$_POST['Libelle'],$_POST['Montant'],'Libelle','Montant','id_Categ_Bourse',$_SESSION['id_Categ_Bourse_mod']);
                header("location: bourses.php?title=Bourses");
            }
            else{
                $_SESSION['donnees']=$_POST;
                header("location: bourses.php?title=Bourses&existe=true");
            }
            
        }
        if(isset($_POST['valider_ajout_ch'])){
            $existe=false;
            $id_bat='';
            $id_bat=EtudiantService::find('Batiment','id_Batiment','Nom_bat',$_POST['Batiment'])[0]->id_Batiment;
            if(EtudiantService::find('Chambres','id_Chambre','Numero_Ch',$_POST['chambre']."') AND UPPER(id_Batiment) = UPPER('$id_bat")!=null) $existe=true;//Modification de la fonction find (addaptation)
            if($existe==false){
                $id_bat=EtudiantService::find('Batiment','id_Batiment','Nom_bat',$_POST['Batiment'])[0]->id_Batiment;
                $batiment=new Batiment($id_bat,'');
                $chambre=new Chambres($_POST['chambre'],$batiment);
                EtudiantService::addCh($chambre);
                header("location: chambres.php?title=Chambres");
            }
            else{
                $_SESSION['donnees_ch']=$_POST;
                header("location: chambres.php?title=Chambres&existe=true");
            }
        }
        if(isset($_POST['valider_modif_ch'])){
            $existe=false;
            $id_bat='';
            $id_bat=EtudiantService::find('Batiment','id_Batiment','Nom_bat',$_POST['Batiment'])[0]->id_Batiment;
            if(EtudiantService::find('Chambres','id_Chambre','Numero_Ch',$_POST['chambre']."') AND UPPER(id_Batiment) = UPPER('$id_bat")!=null) $existe=true;
            
            if($existe==false){
                $id_bat=EtudiantService::find('Batiment','id_Batiment','Nom_bat',$_POST['Batiment'])[0]->id_Batiment;
                EtudiantService::updateTable('Chambres',$_POST['chambre'],$id_bat,'Numero_Ch','id_Batiment','id_Chambre',$_SESSION['id_Chambre']);
                header("location: chambres.php?title=Chambres");
            }
            else{
                $_SESSION['donnees_ch']=$_POST;
                header("location: chambres.php?title=Chambres&existe=true&mod=true");
            }
        }
        if(isset($_GET['id_Chambre_sup'])){
            $id_Ch=$_GET['id_Chambre_sup'];
            $dejaMigrer=false;
            if(EtudiantService::find('Loges','id_Chambre','id_Chambre',$id_Ch)!=null) $dejaMigrer=true;
            if($dejaMigrer==false){
                EtudiantService::delete('Chambres','id_Chambre',$id_Ch);
                header("location: chambres.php?title=Chambres");
            }
            else{
                header("location: chambres.php?title=Chambres&dejaMigrer=true");
            }
        }
        if(isset($_POST['valider_ajout_batiment'])){
            $existe=false;
            if(EtudiantService::find('Batiment','Nom_bat','Nom_bat',$_POST['batiment'])!=null) $existe=true;
            if($existe==false){
                $batiment=new Batiment('',$_POST['batiment']);
                EtudiantService::addBat($batiment);
                header("location: batiments.php?title=Batiments");
            }
            else{
                $_SESSION['donnees_bat']=$_POST;
                header("location: batiments.php?title=Batiments&existe=true");
            }
        }
        if(isset($_GET['id_Batiment_sup'])){
            $id_Ch=$_GET['id_Batiment_sup'];
            $dejaMigrer=false;
            if(EtudiantService::find('Chambres','id_Batiment','id_Batiment',$id_Ch)!=null) $dejaMigrer=true;
            if($dejaMigrer==false){
                EtudiantService::delete('Batiment','id_Batiment',$id_Ch);
                header("location: batiments.php?title=Batiments");
            }
            else{
                header("location: batiments.php?title=Batiments&dejaMigrer=true");
            }
        }
        if(isset($_POST['valider_modif_batiment'])){
            $existe=false;
            $id_bat=Validation::securisation($_SESSION['id_Batiment_mod']);
            if($Nom_bat=EtudiantService::find('Batiment','Nom_bat','Nom_bat',$_POST['batiment'])[0]->Nom_bat){
                if(EtudiantService::find('Batiment','Nom_bat','id_Batiment',$id_bat)[0]->Nom_bat!=$Nom_bat)
                $existe=true;
            }
            if($existe==false){
                $valeur=Validation::securisation($_POST['batiment']);
                $requete = (Bdd::getPDO())->prepare( "UPDATE `Batiment` SET Nom_bat='$valeur' WHERE id_Batiment='$id_bat'");
                $requete->execute();
                header("location: batiments.php?title=Batiments");
            }
            else{
                $_SESSION['donnees_bat']=$_POST;
                header("location: batiments.php?title=Batiments&existe=true");
            }
        }
        if(isset($_POST['connexion'])){
            if( $_POST['mon_login']=='root' && $_POST['mdp']=='101419'){
                $_SESSION['valider']=true;
                header('location: accueil.php?title=Accueil');
            }else {
                $_SESSION['valider']=false;
                $_SESSION['log_mdp']=$_POST;
                header('location: ../index.php');
            }
        }
    }
    catch(PDOException $e){
        echo "ECHEC : " . $e->getMessage();
    }
?> 