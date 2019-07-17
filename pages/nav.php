<?php
echo '<nav class="navbar navbar-expand-lg navbar-light row fixed-top" style="background-color: #141517;">

  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav col-12 mr-auto">
      <li class="nav-item  ';if ($_GET['title'] == "Accueil") {echo 'active';}echo '">
        <a class="nav-link" href="accueil.php?title=Accueil">Accueil<span class="sr-only">(current)</span></a>
      </li>';
        echo'<li class="nav-item ';if ($_GET['title'] == "Etudiants") {echo 'active';}echo '">
          <a class="nav-link" href="etudiants.php?title=Etudiants">Gestion des étudiants</a>
        </li>
        <li class="nav-item ';if ($_GET['title'] == "Bourses") {echo 'active';}echo '">
          <a class="nav-link" href="bourses.php?title=Bourses">Gestion des bourses</a>
        </li>
        <li class="nav-item ';if ($_GET['title'] == "Chambres") {echo 'active';}echo '">
          <a class="nav-link" href="chambres.php?title=Chambres">Gestions des chambres</a>
        </li>
        <li class="nav-item ';if ($_GET['title'] == "Batiments") {echo 'active';}echo '">
          <a class="nav-link" href="batiments.php?title=Batiments">Gestions des batiments</a>
        </li>';
      echo'<li class="nav-item deco">
        <a class="nav-link" href="deconnexion.php?title=">Déconnexion</a>
      </li>
    </ul>
  </div>
</nav>';
?>
