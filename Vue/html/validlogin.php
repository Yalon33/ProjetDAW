<?php

include("../../Modele/bdd.php");


$id=3;
$password="test";

function veriftest($nom, $password)
{
    BDD::getinstance()->query("SELECT * FROM projet.eleve;");
    echo "test effectuer";

}


veriftest($id, $password);




//echo '<script type/javascript> alert("mdp incorrect donc ntm"); ';
//echo ' document.location.href="login.html";';
//echo '</script>';
?>