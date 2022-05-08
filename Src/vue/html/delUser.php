<div class="userpage_contenu_inner">
    <div class="coordonne">
        <p>Informations de l'utilisateur à supprimer</p>
        <form action="" method="post" class="coordonne">
            <section>
                <label for="login_user">Login :</label>
                <input type="text" name="name_user" id="name_user">
            </section>
            <section>
                <label for="prenom_user">Prenom :</label>
                <input type="text" name="prenom_user" id="prenom_user">
            </section>
            <section>
                <label for="nom_user">Nom :</label>
                <input type="text" name="nom_user" id="nom_user">
            </section>
            <section>
                <button class="user"><i class='bx bx-x'></i>Supprimer</button>  
            </section>
        </form>
        <?php if(array_key_exists("delUser", $_SESSION) and $_SESSION["delUser"] == false): ?>
            <p>Une erreur est survenue lors de la suppression de cet utilisateur, veuillez vérifier ses identifiants</p>
        <?php unset($_SESSION["delUser"]); endif; ?>
    </div>
    <div>
        <p>Liste de utilisateur :</p>
        <ul>
            <?php foreach($users as $u): ?>
                <li>
                    <p>Login: <?php echo $u->getLogin(); ?>
                    <p>Prenom: <?php echo $u->getPrenom(); ?>
                    <p>Nom: <?php echo $u->getNom(); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>