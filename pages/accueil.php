<?php require("haut_de_page.php");?>
<?php if ($_SESSION['valider']==false) {header('Location: ../index.php'); exit();}?>  
<body>
    <?php include('nav.php');?>
    <section class="container sect">
        <div class="row">
            <div class="col-3"></div>
            <h1 class="textAc col-6">Répartition étudiants</h1>
        </div>
        <div class='row diagCircl'>
            <div class='col-1'></div>
            <div class='col-4'>
                <?php $non_bour=(count(EtudiantService::find('Non_Boursiers'))*100)/count(EtudiantService::find('Etudiants'));?>
                 <a href="lister.php?title=Afficher&nonBoursier" target="_blank" class="nonSoulign">    
                    <div <?php echo 'class="c100 p'.intval($non_bour).' big"'; ?>>
                        <span><?php echo intval($non_bour).'%';?></span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </a>   
            </div>
            <div class='col-4'>
                <?php $bour=(count(EtudiantService::find('Boursiers'))*100)/count(EtudiantService::find('Etudiants'));?>
                <a href="lister.php?title=Afficher&Boursier" target="_blank" class="nonSoulign">    
                    <div <?php echo 'class="c100 p'.intval($bour).' big"'; ?>>
                        <span><?php echo intval($bour).'%';?></span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class='col-3'>
                <?php $loger=(count(EtudiantService::find('Loges'))*100)/count(EtudiantService::find('Etudiants'));?>
                <a href="lister.php?title=Afficher&Logers" target="_blank" class="nonSoulign">
                    <div <?php echo 'class="c100 p'.intval($loger).' big"'; ?>>  
                        <span><?php echo intval($loger).'%';?></span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class='row '>
            <div class='col-4'>
                <a href="lister.php?title=Afficher&nonBoursier" target="_blank" class="nonSoulign"><p class="titreCircle t1">Non boursiers</p></a>
            </div>
            <div class='col-4'>
                <a href="lister.php?title=Afficher&Boursier" target="_blank" class="nonSoulign"><p class="titreCircle t2">Boursiers</p></a>
            </div>
            <div class='col-3'>
                <a href="lister.php?title=Afficher&Logers" target="_blank" class="nonSoulign"><p class="titreCircle titreCirLog t3">Logers</p></a>
            </div>
        </div>

    </section>
</body>
<?php require("footer.php");?>