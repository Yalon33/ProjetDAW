<div class="userpage_contenu_inner">
    <div class="coordonne_add">
        <p>Ajouter un canal</p>
        <form action="" method="post" class="coordonne_add">
            <section>
                <label for="forum_form">Nom de forum : </label>
                <input type="text" name="forum__form" id="forum__form" value="<?php echo $f ?>" readonly="readonly"/>
            </section>
            <section>
                <label for="createur_form">Nom de Créateur : </label>
                <input type="text" name="createur__form" id="createur__form" value="<?php echo $_SESSION['user']->getNom() ?>" readonly="readonly"/>
            </section>
            <section>
                <label for="nom_form">Nom de canal : </label>
                <input type="text" name="nom_form" id="nom_form" />
            </section>
            <section>
                <button class="add"><i class='bx bx-plus-circle icon_add'></i><span>Ajouter</span></button>
            </section>
        </form>
        <?php if(array_key_exists("newCanal", $_SESSION) and $_SESSION['newCanal'] == false): ?>
            <p>Impossible de créer le canal, le nom du canal ne peut pas être vide</p>
        <?php endif; ?>
    </div>
</div>