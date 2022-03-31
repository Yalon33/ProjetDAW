<?php
//setcookie('personne','etudiant', time() + 3600*24*365,null,null,true);
include("../../Modele/bdd.php");

function redirectWrongLogin()
{
echo '<script type/javascript> alert("mdp/login incorrect"); ';
echo ' document.location.href="login.html";';
echo '</script>';
}


function redirectGoodLogin()
{
echo '<script type/javascript>  ';
echo ' document.location.href="userpage.html";';
echo '</script>';
}
//Recupration du contenu de l'item form avec le "name" = login_form(défini dans login.html); 
$contenuLogin =$_POST['login_form'] ; 
//Recuperation du contenu de l'item form avec le "name" password_form (défini dans login.html); 
$contenuMdp=$_POST['password_form']; 




$resultat;
$id;

function veriftest($nom, $password)
{
    $contenuLogin =$_POST['login_form'] ; 
    $contenuMdp=$_POST['password_form']; 
    $resultat=BDD::getinstance()->query("SELECT login, mdp FROM projet.utilisateur WHERE login='$nom' AND mdp='$password';");
 
   
    if($resultat->fetch())
    {
        redirectGoodLogin();
    }
    else
    {
        redirectWrongLogin();
    }
 
}


//Partie attribution de cookie
if($contenuLogin=="etudiant")
{
    setcookie('personne','etudiant', time() + 3600*24*365,null,null,true);
    echo "Bienvenue a un etudiant";
}
else if($contenuLogin=="admin")
{
echo "bienvenue a un admin ";
setcookie('personne','admin', time() + 3600*24*365,null,null,true);
}
else
{
    //redirectWrongLogin();
    setcookie('personne','visiteur', time() + 3600*24*365,null,null,true);
}

veriftest($contenuLogin,$contenuMdp);

?>