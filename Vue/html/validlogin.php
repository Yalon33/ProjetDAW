<?php
//setcookie('personne','etudiant', time() + 3600*24*365,null,null,true);
include("../../Modele/bdd.php");

function redirectWrongLogin()
{
echo '<script type/javascript> alert("mdp/login incorrect"); ';
echo ' document.location.href="login.html";';
echo '</script>';
}

$resultat;
$id;
function veriftest($nom, $password)
{
    $resultat=BDD::getinstance()->query("SELECT login, mdp FROM projet.eleve WHERE login='$nom' AND mdp='$password';");
    echo "test effectuer";
    while ($id = $resultat->fetch())
    {
       echo $id['login'] . '<br />';
    }

}
//Recupration du contenu de l'item form avec le "name" = login_form(défini dans login.html); 
$contenuLogin =$_POST['login_form'] ; 
//Recuperation du contenu de l'item form avec le "name" password_form (défini dans login.html); 
$contenuMdp=$_POST['password_form']; 

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