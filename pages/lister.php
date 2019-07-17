<?php require("haut_de_page.php");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>      
<body>
    <?php include('nav.php');?>
    <section class="container-fluid sect">
         <!-- Debut tableau -->
         <div class="Mes_tableaux lister">
            <?php
            $form=new Form();
            $titres=array('Matricule','Nom','Prenom','Naissance','Email','Telephone','Statut');
            if(isset($_GET['id_Categ_Bourse'])){
                $id_cat=$_GET['id_Categ_Bourse'];
                $codesql="SELECT * FROM `Etudiants` WHERE Etudiants.Matricule IN (SELECT Matricule FROM Boursiers WHERE id_Categ_Bourse='$id_cat')";
            }
            elseif(isset($_GET['id_Chambre'])){
                $id_ch=$_GET['id_Chambre'];
                $codesql="SELECT * FROM `Etudiants` WHERE Etudiants.Matricule IN (SELECT Matricule FROM Loges WHERE id_Chambre='$id_ch')";
            }
            elseif(isset($_GET['id_Batiment'])){
                $id_bat=$_GET['id_Batiment'];
                $codesql="SELECT Matricule,Nom,Prenom,Naissance,Email,Telephone,Numero_Ch FROM `Etudiants`,Chambres WHERE Chambres.id_Batiment='$id_bat' AND Etudiants.Matricule IN (SELECT Matricule FROM Loges WHERE Loges.id_Chambre=Chambres.id_Chambre)";
                $titres=array('Matricule','Nom','Prenom','Naissance','Email','Telephone','Chambre','Statut');
            }
            elseif(isset($_GET['nonBoursier'])){
                $codesql="SELECT * FROM `Etudiants` WHERE Etudiants.Matricule IN (SELECT Matricule FROM Non_Boursiers)";
            }
            elseif(isset($_GET['Boursier'])){
                $codesql="SELECT * FROM `Etudiants` WHERE Etudiants.Matricule IN (SELECT Matricule FROM Boursiers)";
            }
            elseif(isset($_GET['Logers'])){
                $codesql="SELECT * FROM `Etudiants` WHERE Etudiants.Matricule IN (SELECT Matricule FROM Loges)";
            }
            $etudiants=Bdd::recuperation($codesql);
            if($etudiants==null){echo '<script> alert("Aucun étiduants disponibles !");  window.close();</script>'; die();}
            $statut=Affichage::statut_etudiant($etudiants);
            $form->tableau($titres,$etudiants,'display nowrap',$statut);
            
            ?>
        </div>
        <!-- Fin tableau -->
    </section>
</body>
<?php require("footer.php");?>