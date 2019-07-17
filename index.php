<?php require("pages/haut_de_page.php")?>
<?php $_SESSION['valider']=false?>
<?php $validation=''?>
<? if(!isset($_SESSION['log_mdp'])) $_SESSION['log_mdp']=[]; 
die($_SESSION['log_mdp']);?>   
<body>
    <nav class="container nav nav-pills nav-fill fixed-top">
        <a class="nav-link active nav-item navindex" href="#">Authentification</a>
    </nav>
    <section class="container sect">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 MonForm FormIndex">
                <form action="pages/traitement.php" method="POST"> 
                    <?php if(!isset($_SESSION['log_mdp'])) $form=new Form(); else $form=new Form($_SESSION['log_mdp']);?>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <?php if(isset($_SESSION['log_mdp']) && $_SESSION['log_mdp']!='' && $_SESSION['valider']==false) $validation='rougMoins'?>
                        <?php $form->input('text','mon_login','form-control col-md-8 espace '.$validation,'Login','','',true);?>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <?php $form->input('password','mdp','form-control col-md-8 espace '.$validation,'Mot de passe','','',true);?>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>                        
                        <?php $form->submit('connexion','Connexion','form-control col-md-6 espace mb');?>
                    </div>
                     <?php if(isset($_SESSION['log_mdp']) && $_SESSION['log_mdp']!='' && $_SESSION['valider']==false) {?>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <?php $form->label('','Erreur sur l\'un des paramètres !!','col-md-8 espace pourLabel red'); ?> 
                    </div>
                    <?php }?>
                </form>
            </div>
        </div>
    </section>
</body>
<?php require("pages/footer.php");?>