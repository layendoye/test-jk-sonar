<?php require("haut_de_page.php");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>      
<body>
    <?php include('nav.php');?>
    <section class="container-fluid sect">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm">
                <form action="traitement.php" method="POST"> <?php if(isset($_GET['existe'])) $form=new Form($_SESSION['donnees']); else $form=new Form();?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Libellé','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['existe']) && !isset($_GET['id_Categ_Bourse_mod'])){ $form->input('text','Libelle','form-control col-md-7 espace','Libellé','','Libelle',false);?>
                        <?php }elseif(isset($_GET['existe']) && !isset($_GET['id_Categ_Bourse_mod'])){$form->input('text','Libelle','form-control col-md-7 espace blcMoins',$_SESSION['donnees']['Libelle'].' existe déja','','Libelle',false);} 
                            elseif(isset($_GET['id_Categ_Bourse_mod'])) $form->input('text','Libelle','form-control col-md-7 espace','Libellé',EtudiantService::find('Categorie_Bourse','Libelle','id_Categ_Bourse',$_GET['id_Categ_Bourse_mod'])[0]->Libelle,'Libelle',false);?>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <?php $form->label('','Montant','col-md-2 espace pourLabel')?> 
                        <?php if(!isset($_GET['id_Categ_Bourse_mod'])) $form->input('number','Montant','form-control col-md-7 espace','Montant','','Montant',true);
                        elseif(isset($_GET['id_Categ_Bourse_mod'])) {
                            $montant=EtudiantService::find('Categorie_Bourse','Montant','id_Categ_Bourse',$_GET['id_Categ_Bourse_mod'])[0]->Montant;
                            $form->input('number','Montant','form-control col-md-7 espace','Montant',$montant,'Montant',false);}?>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>                        
                        <?php if(!isset($_GET['id_Categ_Bourse_mod'])) $form->submit('valider_ajout_bourse','Ajouter','form-control col-md-5 espace mb','subm');
                            else {
                                $form->submit('valider_mod_bourse','Modifier','form-control col-md-5 espace mb','subm');
                                $_SESSION['id_Categ_Bourse_mod']=$_GET['id_Categ_Bourse_mod'];
                            }
                        ?>
                    </div>
                    
                </form>
            </div>
        </div>
         <!-- Debut tableau -->
         <div class="Mes_tableaux">
            <?php
            $titres=array('Numero','Libellé','Montant','Octroyer','Lister','Modification','Supprimer');
            $bourses=EtudiantService::find('Categorie_Bourse');
            $id_bou=EtudiantService::find('Categorie_Bourse','id_Categ_Bourse');
            $mod=Affichage::bouton($id_bou,$pages='bourses.php',$title='Bourses',$trite_Get='id_Categ_Bourse_mod',$class_but='btn btn-outline-primary btinf',$nom_But='Modifier');
            $sup=Affichage::bouton($id_bou,$pages='bourses.php',$title='Bourses',$trite_Get='id_Categ_Bourse_sup',$class_but='btn btn-outline-danger btinf',$nom_But='Supprimer');
            $nmbrEt=Affichage::nmbr_et_Bourse($id_bou);
            $lister=Affichage::bouton($id_bou,$pages='lister.php',$title='Afficher',$trite_Get='id_Categ_Bourse',$class_but='btn btn-outline-info btinf',$nom_But='Lister',$blank=true);
            $form->tableau($titres,$bourses,'display nowrap',$nmbrEt,$lister,$mod,$sup);
            ?>
        </div>
        <!-- Fin tableau -->
    </section>
</body>
<?php 
    if(isset($_GET["id_Categ_Bourse_sup"])){
        $sonId=$_GET["id_Categ_Bourse_sup"];
        $sup='id_Categ_Bourse_sup='.$sonId
        ?>
        <script>
            if(confirm("Confirmer la suppression ?"))
                document.location.href = "traitement.php?title=traitement&<?php echo "$sup"; ?>"
            else
                document.location.href = "bourses.php?title=Bourses";
        </script>
        <?php } elseif(isset($_GET["dejaMigrer"])){?>
         <script>alert('Impossible de supprimer cette catégorie de bourse on l\'a déja octroyé à un ou plusieurs étudiants !')</script>
    <?php }
    require("footer.php");
?>