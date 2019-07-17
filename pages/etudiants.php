<?php require("haut_de_page.php");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>
<?php if(isset($_SESSION['donnees_etudiants']) && !isset($_GET['ChoiCh']) || isset($_GET['annuler'])) unset($_SESSION['donnees_etudiants']);?>
<?php if(!isset($_GET['matricule_modif']) && isset($_SESSION['modif_actuel'])|| isset($_GET['annuler'])) unset( $_SESSION['modif_actuel'])?>      
<body>
    <?php include('nav.php');?>
    <section class="container-fluid sect">
        <!-- Début formulaire -->
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 MonForm">
                    <?php if(isset($_GET['matricule_modif'])) {$etu=EtudiantService::info($_GET['matricule_modif']); $_SESSION['modif_actuel']='matricule_modif='.$_GET['matricule_modif'];}//recupere les élements presents dans le liens?>
                    <form <?php if(!isset($_GET['matricule_modif'])) echo 'action="traitement.php?title=traitement"'; else echo 'action="traitement.php?title=traitement&matricule_modif='.$_GET['matricule_modif'].'"';?> method="POST" id='MonForm'> 
                        <?php if(isset($_SESSION['donnees_etudiants']) && $_GET['ChoiCh']==true) $form=new Form($_SESSION['donnees_etudiants']); else $form=new Form();?>
                        
                        <?php /////////////////--------------------Début Nom------------------///////////////////////////?>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <?php $form->label('','Nom','col-md-2 espace pourLabel')?> 
                                <?php if(!isset($_GET['matricule_modif'])) {$form->input('text','nom','form-control col-md-7 espace','Nom','','Nom',true);?>
                                <?php }else $form->input('text','nom','form-control col-md-7 espace','Nom',$etu['Nom'],'Nom',false,'',false);?>
                            </div>
                        <?php /////////////////--------------------Fin Nom------------------///////////////////////////?>
                        
                        <?php /////////////////--------------------Début Prenom------------------///////////////////////////?>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <?php $form->label('','Prénom','col-md-2 espace pourLabel')?> 
                                <?php if(!isset($_GET['matricule_modif'])) {$form->input('text','prenom','form-control col-md-7 espace','Prénom','','prenom',true);?>
                                <?php }else $form->input('text','prenom','form-control col-md-7 espace','Prénom',$etu['Prenom'],'prenom',false,'',false);?>
                            </div>
                        <?php /////////////////--------------------Fin Prenom------------------///////////////////////////?>
                        
                        <?php /////////////////--------------------Début Naissance------------------///////////////////////////?>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <?php $form->label('','Naissance','col-md-2 espace pourLabel')?> 
                                <?php if(!isset($_GET['matricule_modif'])) {$form->input('date','naiss','form-control col-md-7 espace','','','naiss',true);?>
                                <?php }else $form->input('date','naiss','form-control col-md-7 espace','',$etu['Naissance'],'naiss',false,'',false);?>
                            </div>
                        <?php /////////////////--------------------Fin Naissance------------------///////////////////////////?>
                        
                        <?php /////////////////--------------------Début Email------------------///////////////////////////?>
                            <div class="row">
                                <div class="col-md-1"></div>
                            <?php $form->label('','Email','col-md-2 espace pourLabel')?> 
                                <?php if(!isset($_GET['matricule_modif'])) {$form->input('email','email','form-control col-md-7 espace','Email','','email',true);?>
                                <?php }else $form->input('email','email','form-control col-md-7 espace','Email',$etu['Email'],'email',false,'',false);?>
                            </div>
                        <?php /////////////////--------------------Fin Email------------------///////////////////////////?>
                        
                        <?php /////////////////--------------------Début téléphone------------------///////////////////////////?>
                            <div class="row">
                                <div class="col-md-1"></div>
                            <?php $form->label('','Téléphone','col-md-2 espace pourLabel')?> 
                                <?php if(!isset($_GET['matricule_modif'])) {$form->input('number','tel','form-control col-md-7 espace','Téléphone','','tel',true);?>
                                <?php }else $form->input('number','tel','form-control col-md-7 espace','Téléphone',$etu['Telephone'],'tel',false,'',false);?>
                            </div>
                        <?php /////////////////--------------------Fin téléphone------------------///////////////////////////?>
                        
                        <?php /////////////////--------------------Début Choix statut------------------///////////////////////////?>
                            <div class="row" <?php if(isset($_GET['Statut_et'])) echo 'id="Statut '.$_GET['Statut_et'].'"'; //pour afficher les éléments correspondant au statut avec js?>>
                                <?php
                                    $checked1=$checked2=$checked3='';
                                    if(isset($_GET['matricule_modif'])){
                                        if($etu['Statut']['Loge']) $checked3='" checked ';
                                        elseif($etu['Statut']['Boursier']) $checked2='" checked ';
                                        else  $checked1='" checked ';
                                    }
                                    if (isset($_SESSION['donnees_etudiants']['choix']) && $_SESSION['donnees_etudiants']['choix']=='Loger' && !isset($_GET['matricule_modif']) || isset($_SESSION['modif_actuel']) && isset($_GET['ChoiCh'])) $checked3='" checked ';
                                ?>
                                <div class="col-3"></div>
                                <?php $form->input('radio','choix','espace btRadio '.$checked1,'','Non Boursier','nonBoursier','','afficherPourNonBoursier()');?>
                                <?php $form->label('','Non Boursier','espace pourLabel centrerDroite')?> 
                                <div class="col-1"></div>
                                <?php $form->input('radio','choix','espace btRadio'.$checked2,'','Boursier','Boursier','','afficherPourBoursier()');?>
                                <?php $form->label('','Boursier','espace pourLabel centrerDroite ')?>
                                <div class="col-1"></div>
                                <?php $form->input('radio','choix','espace btRadio '.$checked3,'','Loger','Loger','','afficherPourLoge()');?>
                                <?php $form->label('','Loger','espace pourLabel centrerDroite')?>
                            </div>
                        <?php /////////////////--------------------Fin Choix statut------------------///////////////////////////?>
                        
                        <?php /////////////////--------------------Début type de bourse------------------///////////////////////////?>
                            <div class="row" id='typeBourse'>
                                <div class="col-md-1"></div>
                            <?php $form->label('','Bourse','col-md-2 espace pourLabel')?>
                                <?php $tab_option=EtudiantService::find('Categorie_Bourse','Libelle');
                                if(!isset($_GET['matricule_modif'])) {$form->select($tab_option,'type_bour','form-control col-md-7 espace');?>
                                <?php }else{
                                    $lib="";
                                    if(isset($etu['Libelle'])) $lib=$etu['Libelle'];
                                    $form->select($tab_option,'type_bour','form-control col-md-7 espace ' ,$lib);
                                }?>
                            </div>
                        <?php /////////////////--------------------Fin type de bourse------------------///////////////////////////?>
                        
                        <?php /////////////////--------------------Début Batiment------------------///////////////////////////?>
                            <div class="row" id='Batiment'>
                                <div class="col-md-1"></div>
                                <?php $form->label('','Batiment','col-md-2 espace pourLabel')?>
                                <?php 
                                    if(isset($_SESSION['donnees_etudiants']['Batiment']) && !isset($_GET['matricule_modif']) || isset($_SESSION['donnees_etudiants']['Batiment']) && isset($_GET['matricule_modif']) && isset($_GET['ChoiCh'])) $cocher=$_SESSION['donnees_etudiants']['Batiment']; 
                                    elseif(isset($_GET['matricule_modif']) && isset($etu['id_Batiment'])) $cocher=$etu['id_Batiment'];
                                    else $cocher='';
                                    //die(var_dump($_SESSION['donnees_etudiants']));
                                ?>
                                <?php Affichage::selectBat('Batiment','form-control col-md-7 espace',$cocher)?> 
                            </div>
                        <?php /////////////////--------------------Fin Batiment------------------///////////////////////////?>
                        
                        <?php /////////////////--------------------Début Chambre------------------///////////////////////////?>
                            <?php if(isset($_SESSION['donnees_etudiants']['Batiment']) && $_SESSION['donnees_etudiants']['choix']=='Loger' || isset($_GET['matricule_modif']) && isset($etu['id_Batiment'])){?>
                                <div class="row" id='Chambre'>
                                    <div class="col-md-1"></div>
                                    <?php if(!isset($_GET['matricule_modif']) || isset($_GET['matricule_modif']) && isset($etu['id_Batiment']) || isset($_GET['matricule_modif']) && $_SESSION['donnees_etudiants']['choix']=='Loger' ) $form->label('','Chambre','col-md-2 espace pourLabel');?> 
                                    <?php if(!isset($_GET['matricule_modif']) || isset($_SESSION['donnees_etudiants']) && isset($_GET['matricule_modif']) && $_SESSION['donnees_etudiants']['choix']=='Loger') {Affichage::selectChambre('chambre','form-control col-md-7 espace',$_SESSION['donnees_etudiants']['Batiment']);?>
                                    <?php }elseif(isset($etu['id_Batiment'])) Affichage::selectChambre('chambre','form-control col-md-7 espace',$etu['id_Batiment'],$etu['id_Chambre']);?>
                                </div>
                            <?php }?>
                        <?php /////////////////--------------------Fin Chambre------------------///////////////////////////?>
                        
                        <?php /////////////////--------------------Début Adresse------------------///////////////////////////?>
                            <div class="row" id='adresse'>
                                <div class="col-md-1"></div>
                            <?php $form->label('','Adresse','col-md-2 espace pourLabel')?> 
                                <?php if(!isset($_GET['matricule_modif']) || isset($_GET['matricule_modif'])&& !isset($etu['Adresse'])) {$form->input('text','adresse','form-control col-md-7 espace','Adresse','','ladresse');?>
                                <?php }elseif(isset($etu['Adresse'])) $form->input('text','adresse','form-control col-md-7 espace','Adresse',$etu['Adresse'],'ladresse',false,'',false);?>
                            </div>
                        <?php /////////////////--------------------Fin Adresse------------------///////////////////////////?>
                        
                        <?php /////////////////--------------------Début submit------------------///////////////////////////?>
                            <div class="row">
                                <div class="col-md-4"></div>                        
                                <?php if(!isset($_GET['matricule_modif']) ) {$form->submit('valider_ajout_etudiant','Ajouter','form-control col-md-5 espace mb','subm');?>
                                <?php }else $form->submit('valider_modif_etudiant','Modifier','form-control col-md-5 espace mb bvalider','subm');?>
                                <?php //$form->submit('AnnulerEtu','Annuler','form-control col-md-3 espace mb annuler','');?>
                            </div>
                        <?php /////////////////--------------------Fin submit------------------///////////////////////////?>

                    </form>
                </div>
            </div>
        <!-- Fin formulaire -->

        <?php /////////////////--------------------Début Pop-Up------------------///////////////////////////?>
            <?php if(isset($_GET['popUp'])){?>
                <?php $etu=EtudiantService::info($_GET['popUp'])?>
                <div class="popUp" id="popUp">
                    <div class="ligne">
                        <p class="left">Matricule </p><strong>:</strong>
                        <p class='right'><?php echo "SA-".$_GET['popUp']?></p>
                    </div>

                    <div class="ligne">
                        <p class="left">Nom </p><strong>:</strong>
                        <p class='right'><?php echo $etu['Nom']?></p>
                    </div>

                    <div class="ligne">
                        <p class="left">Prénom </p><strong>:</strong>
                        <p class='right'><?php echo $etu['Prenom']?></p>
                    </div>

                    <div class="ligne">
                        <p class="left">Naissance </p><strong>:</strong>
                        <p class='right'><?php echo Validation::dateFr($etu['Naissance']);?></p>
                    </div>

                    <div class="ligne">
                        <p class="left">Email </p><strong>:</strong>
                        <p class='right'><?php echo $etu['Email']?></p>
                    </div>

                    <div class="ligne">
                        <p class="left">Téléphone </p><strong>:</strong>
                        <p class='right'><?php echo $etu['Telephone']?></p>
                    </div>

                    <?php if(isset($etu['Libelle'])){?>
                        <div class="ligne">
                            <p class="left">Bourse </p><strong>:</strong>
                            <p class='right'><?php echo $etu['Libelle'].' ('.Validation::millier($etu['Montant']).')'?></p>
                        </div>
                    <?php }?>

                    <?php if(isset($etu['Nom_bat'])){?>
                        <div class="ligne">
                            <p class="left">Batiment</p><strong>:</strong>
                            <p class='right'><?php echo $etu['Nom_bat']?></p>
                        </div>
                    <?php }?>

                    <?php if(isset($etu['Numero_Ch'])){?>
                        <div class="ligne">
                            <p class="left">Chambre</p><strong>:</strong>
                            <p class='right'><?php echo 'Chambre '.$etu['Numero_Ch']?></p>
                        </div>
                    <?php }?>

                    <?php if(isset($etu['Adresse'])){?>
                        <div class="ligne">
                            <p class="left">Adresse</p><strong>:</strong>
                            <p class='right'><?php echo $etu['Adresse']?></p>
                        </div>
                    <?php }?>
                    
                    <div class="ligne bout">
                        <p class="left"><a href="etudiants.php?title=Etudiants"class="nonSoulign"><button class="form-control">Valider</button></a></p>
                        <p class='left'><a class="nonSoulign"<?php echo 'href="etudiants.php?title=Etudiants&matricule_modif='.$_GET['popUp'].'&Statut_et='.Affichage::statut_etu($_GET['popUp']).'"';?>><button class="form-control">Modifier</button></a></p>
                    </div>
                </div>
            <?php }?>
        <?php /////////////////--------------------Fin Pop-Up------------------///////////////////////////?>
        
        <!-- Début tableau -->
            <div class="Mes_tableaux">
                <?php
                $titres=array('Matricule','Nom','Prenom','Naissance','Email','Telephone','Statut','Infos','Modifier','Supprimer');
                $etudiants=EtudiantService::find('Etudiants');
                
                $statut=Affichage::statut_etudiant($etudiants);
                $matricules=EtudiantService::find('Etudiants','Matricule');
                $mod=Affichage::bouton_modif_etudiant($etudiants);
                $sup=Affichage::bouton($matricules,$pages='etudiants.php',$title='Etudiants',$trite_Get='matricule_sup',$class_but='btn btn-outline-danger btinf',$nom_But='Supprimer');
                $info=Affichage::bouton($matricules,$pages='etudiants.php',$title='Etudiants',$trite_Get='popUp',$class_but='btn btn-outline-info btinf',$nom_But='Infos');
                $form->tableau($titres,$etudiants,'display nowrap',$statut,$info,$mod,$sup);
                ?>
            </div>
        <!-- Fin tableau -->

    </section>
</body>
<?php //suppression et nombres étudiants/chambres 

    ///////////-----Début validation suppression---////////
    if(isset($_GET["matricule_sup"])){
        $sonId=$_GET["matricule_sup"];
        $sup='matricule_sup='.$sonId;
        ?>
        <script>
            if(confirm("Confirmer la suppression ?")){
                document.location.href = "traitement.php?title=traitement&<?php echo "$sup"; ?>";
            }
            else{
                document.location.href = "etudiants.php?title=Etudiants";
            }
        </script>
        <?php
    }
    ///////////-----Fin validation suppression---////////

    ///////////-----Début validation nombre étudiant par chambre---////////
    if(isset($_GET["Chpleine"])){
         ?>
        <script>
            alert('La chambre '+ <?php echo $_GET["Chpleine"]?> +' est pleine elle contient déja 4 étudiants !')
        </script>
        <?php
    }
    ///////////-----Finvalidation nombre étudiant par chambre---////////
    
?>
<?php require("footer.php");?>