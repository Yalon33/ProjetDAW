<?php

include("../../Modele/bdd.php");


$id=3;
$password="test";

function veriftest($nom, $password)
{
    BDD::getinstance()->query("SELECT * FROM projet.eleve;");
    echo "test effectuer";

}

//$_POST car on a choisit la method form dans login.html; 
//Recupration du contenu de l'item form avec le "name" = login_form(défini dans login.html); 
$contenuLogin =$_POST['login_form'] ; 
//Recuperation du contenu de l'item form avec le "name" password_form (défini dans login.html); 
$contenuMdp=$_POST['password_form']; 
echo $contenuLogin; 
echo $contenuMdp; 
//Faire une requête avec le contenu du login/password 
 
//Faire l'attribution des cookies en fonction de la connection / Et par défaut ? 
 
 

veriftest($id, $password);




//echo '<script type/javascript> alert("mdp incorrect donc ntm"); ';
//echo ' document.location.href="login.html";';
//echo '</script>';
?>