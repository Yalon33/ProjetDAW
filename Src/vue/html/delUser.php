<div class="userpage_contenu_inner">
    <div class="coordonne">
        <p>Voulez-vous vraiment supprimer l'utilisateur?</p>
        <form action="" method="post" class="coordonne">
            <input type=radio name=choix value="oui" checked>
            <label>Oui</label>
            <input type=radio name=choix value="non">
            <label>Non</label>
            <input type=submit value="valider">
        </form>
        <?php if(array_key_exists("delUser", $_SESSION) and $_SESSION["delUser"] == false): ?>
            <p>Une erreur est survenue lors de la suppression de cet utilisateur</p>
        <?php unset($_SESSION["delUser"]); endif; ?>
    </div>
</div>