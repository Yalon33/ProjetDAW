<div class="userpage_contenu_inner">
    <div class="coordonne_add">
        <p>Ajouter un forum</p>
        <form action="" method="post" class="coordonne_add">
            <section>
                <label for="nom_form">Nom de forum : </label>
                <input type="text" name="nom_form" id="nom_form" />
            </section>
            <section>
                <label for="createur_form">Nom de créateur : </label>
                <input type="text" name="createur_form" id="createur_form" value="<?php echo $_SESSION['user']->getNom() ?>" readonly="readonly"/>
            </section>
            <section>
                <button class="add"><span>Ajouter</span></button>
            </section>
        </form>
        <?php if(array_key_exists("newForum", $_SESSION) and $_SESSION["newForum"] == false): ?>
            <p>Impossible de créer le forum, le nom du forum ne peut pas être vide</p>
        <?php endif; ?>
    </div>
</div>