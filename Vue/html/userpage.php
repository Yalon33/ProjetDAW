<!DOCTYPE html>
<html lang="en">
<head>
<title>User Page</title>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="../css/userpage.css">
<link rel="stylesheet" href="../css/menu.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true"> 
</head>
    <body class="dark">
        
        <?php include("./menu.html");?>

        <div class="page_contenu">
            
            <?php include("./banderole.html");?>

            <div class="userpage_contenu_inner">
                <ul class="user_coordonne">
                    <li>
                        <div class="coordonne">
                            <p>Généralités</p>
                            <form class="coordonne">
                                <section>
                                    <label for="numero_user">N°Dossier:</label>
                                    <input type="text" name="numero_user" id="numero_user">
                                </section>
                                <section>
                                    <label for="name_user">Prénom et Nom:</label>
                                    <input type="text" name="name_user" id="name_user">
                                </section>
                                <section>
                                    <label for="nation_user">Nationalité:</label>
                                    <input type="text" name="nation_user" id="nation_user">
                                </section>
                                <section>
                                    <label for="birthday_user">Date de naissance:</label>
                                    <input type="text" name="birthday_user" id="birthday_user">
                                </section>
                            </form>
                        </div>
                    </li>

                    <li>
                        <div class="coordonne">
                            <p>Etablissement</p>
                            <form class="coordonne">
                                <section>
                                    <label for="universite_user">Université:</label>
                                    <input type="text" name="telephone_user" id="telephone_user">
                                </section>
                                <section>
                                    <label for="city_universite_user">Ville:</label>
                                    <input type="text" name="city_universite_user" id="city_universite_user">
                                </section>
                                <section>
                                    <label for="cycle_universite_user">Cycle:</label>
                                    <input type="text" name="cycle_universite_user" id="cycle_universite_user">
                                </section>
                                <section>
                                    <label for="password_user">Année:</label>
                                    <input type="text" name="year_universite_user" id="year_universite_user">
                                </section>
                            </form>
                        </div>
                    </li>
                    
                </ul>
                <ul class="user_coordonne">
                    <li>
                        <div class="coordonne">
                            <p>Baccalauréat</p>
                            <form class="coordonne"> 
                                <section>
                                    <label for="bacc_user">Baccalauréat:</label>
                                    <input type="text" name="bacc_user" id="bacc_user">
                                </section>
                                <section>
                                    <label for="year_bacc_user">Année:</label>
                                    <input type="text" name="year_bacc_user" id="year_bacc_user">
                                </section>
                                <section>
                                    <label for="mention_bacc_user">Mention:</label>
                                    <input type="text" name="mention_bacc_user" id="mentison_bacc_user">
                                </section>
                                <section>
                                    <label for="school_bacc_user">Etablissement:</label>
                                    <input type="text" name="school_bacc_user" id="school_bacc_user">
                                </section>
                            </form>
                        </div>
                    </li>
                    <li>
                        <div class="coordonne">
                            <p>Contact</p>
                            <form class="coordonne">
                                <section>
                                    <label for="telephone_user">Portable:</label>
                                    <input type="text" name="telephone_user" id="telephone_user">
                                </section>
                                <section>
                                    <label for="email_pro_user">Email personnel:</label>
                                    <input type="text" name="email_pro_user" id="email_pro_user">
                                </section>
                                <section>
                                    <label for="login_user">Nom d'utilisateur:</label>
                                    <input type="text" name="login_user" id="login_user">
                                </section>
                                <section>
                                    <label for="password_user">Mot de passe:</label>
                                    <input type="text" name="password_user" id="password_user">
                                </section>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            
            <button><i class='bx bx-sync'></i>Update</button>  
        </div>

</body>
<script src="../javascript/userpage.js"></script>
</html>