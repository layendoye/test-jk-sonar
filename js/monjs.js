///////////////-----------Début DataTable-------------////
$(document).ready(function() {
    var table = $('#example').DataTable();
    $('#example tbody').on('mouseenter', 'td', function() {
        var colIdx = table.cell(this).index().column;
        $(table.cells().nodes()).removeClass('highlight');
        $(table.column(colIdx).nodes()).addClass('highlight');
    });
});
$('#example').DataTable({
    language: {
        processing: "Traitement en cours...",
        search: "Rechercher&nbsp;:",
        lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
        info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix: "",
        loadingRecords: "Chargement en cours...",
        zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable: "Aucune donnée disponible dans le tableau",
        paginate: { first: "Premier", previous: "Pr&eacute;c&eacute;dent", next: "Suivant", last: "Dernier" },
        aria: { sortAscending: ": activer pour trier la colonne par ordre croissant", sortDescending: ": activer pour trier la colonne par ordre décroissant" }
    }
});


///////////////-----------Fin DataTable-------------////

////////////----Début Page étudidant----////////
var nom_page = window.location.pathname;
if (nom_page.includes("etudiants.php")) {
    var nom = document.getElementById('Nom');
    var prenom = document.getElementById('prenom');
    var naissance = document.getElementById('naiss');
    var email = document.getElementById('email');
    var tel = document.getElementById('tel');
    var choix = document.getElementsByName('choix'); //la div qui recupere le statut
    var typeBourse = document.getElementById('typeBourse'); //la div
    var batiment = document.getElementById('Batiment'); //la div
    var chambre;
    var adresse = document.getElementById('adresse'); //la div
    var sendForm = document.getElementById('subm');
    var nonBoursier = document.getElementById('nonBoursier');
    var loger = document.getElementById('Loger');
    var boursier = document.getElementById('Boursier');
    var ladresse = document.getElementById('ladresse');
    var lebatiment = document.getElementById('leBatiment');
    sendForm.addEventListener('click', validation);

    function validation(e) {
        nom.style.backgroundColor = '#fff';
        prenom.style.backgroundColor = '#fff';
        naissance.style.backgroundColor = '#fff';
        email.style.backgroundColor = '#fff';
        if (ladresse) ladresse.style.backgroundColor = '#fff';
        lebatiment.style.backgroundColor = '#fff';
        tel.style.backgroundColor = '#fff';

        if (nom.value == '') {
            nom.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            nom.setAttribute("placeholder", "Remplir le nom !");
            e.preventDefault();
        }
        if (prenom.value == '') {
            prenom.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            prenom.setAttribute("placeholder", "Remplir le prénom !");
            e.preventDefault();
        }
        if (naissance.value == '') {
            naissance.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            alert('Remplir la date de naissance !');
            e.preventDefault();
        }
        var auj = new Date();
        var date_naiss = new Date(naissance.value);
        var c = (auj - date_naiss) / (60 * 60 * 24 * 1000);
        if (date_naiss > auj) {
            naissance.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            alert('Revoir la date de naissance !');
            e.preventDefault();
        }
        if (email.value == '') {
            email.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            email.setAttribute("placeholder", "Remplir l'email !");
            e.preventDefault();
        }
        if (tel.value == '') {
            tel.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            tel.setAttribute("placeholder", "Remplir le téléphone !");
            e.preventDefault();
        }
        if (!loger.checked && !nonBoursier.checked && !boursier.checked) {
            alert('Choisir une catégorie (boursier, loger ou non boursier)!');
            e.preventDefault();
        }

        if (nonBoursier.checked && ladresse.value == '') {
            ladresse.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            ladresse.setAttribute("placeholder", "Remplir l'adresse !");
            e.preventDefault();
        }

        if (loger.checked && lebatiment && lebatiment.selectedIndex == 0) {
            lebatiment.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            e.preventDefault();
        }

    }
    typeBourse.style.display = 'none';
    batiment.style.display = 'none';
    adresse.style.display = 'none';
    if (chambre = document.getElementById('Chambre')) {
        typeBourse.style.display = '';
        batiment.style.display = '';
    };

    function afficherPourBoursier() {
        typeBourse.style.display = '';
        batiment.style.display = 'none';
        adresse.style.display = 'none';
        if (chambre) chambre.style.display = 'none';
    }

    function afficherPourNonBoursier() {
        typeBourse.style.display = 'none';
        batiment.style.display = 'none';
        if (chambre) chambre.style.display = 'none';
        adresse.style.display = '';

    }

    function afficherPourLoge() {
        typeBourse.style.display = '';
        batiment.style.display = '';
        if (chambre) chambre.style.display = '';
        adresse.style.display = 'none';
    }

    var choix;

    if (choix = document.getElementById('Statut Non Boursier')) {
        afficherPourNonBoursier();
    } else if (choix = document.getElementById('Statut Boursier')) {
        afficherPourBoursier();
    } else if (choix = document.getElementById('Statut Loger')) {
        afficherPourLoge();
    }
    ////////////----Début popUp----////////
    var i = 0;
    var monPopUp = document.getElementById('popUp');

    function popUp() {
        i += 0.7;
        monPopUp.style.top = `${i}px`;
        if (window.getComputedStyle(monPopUp).top != '70px') requestAnimationFrame(popUp);
    }
    if (monPopUp) requestAnimationFrame(popUp);
    ////////////----Fin popUp----////////

}
////////////----Fin Page étudidant----////////

////////////----Début Page bourses----////////
var nom_page = window.location.pathname;
if (nom_page.includes("bourses.php")) {
    var libelle = document.getElementById('Libelle');
    var montant = document.getElementById('Montant');
    var sendForm = document.getElementById('subm');
    sendForm.addEventListener('click', validation);

    function validation(e) {
        libelle.style.backgroundColor = '#fff';
        montant.style.backgroundColor = '#fff';

        if (libelle.value == '') {
            libelle.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            libelle.setAttribute("placeholder", "Remplir le libellé !");
            e.preventDefault();
        }
        if (montant.value == '') {
            montant.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            montant.setAttribute("placeholder", "Remplir le montant !");
            e.preventDefault();
        }

    }
}
////////////----Fin Page bourses----////////
////////////----Début Page chambres----////////
var nom_page = window.location.pathname;
if (nom_page.includes("chambres.php")) {
    var chambre = document.getElementById('chambre');
    var sendForm = document.getElementById('subm');
    sendForm.addEventListener('click', validation);

    function validation(e) {
        chambre.style.backgroundColor = '#fff';

        if (chambre.value == '') {
            chambre.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            chambre.setAttribute("placeholder", "Remplir le nom de la chambre !");
            e.preventDefault();
        }
    }
}
////////////----Fin Page chambres----////////
////////////----Début Page chambres----////////
var nom_page = window.location.pathname;
if (nom_page.includes("batiments.php")) {
    var batiment = document.getElementById('batiment');
    var sendForm = document.getElementById('subm');
    sendForm.addEventListener('click', validation);

    function validation(e) {
        batiment.style.backgroundColor = '#fff';

        if (batiment.value == '') {
            batiment.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
            batiment.setAttribute("placeholder", "Remplir le nom de la chambre !");
            e.preventDefault();
        }
    }
}
////////////----Fin Page chambres----////////