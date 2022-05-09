<!-- <div class="userpage_contenu_inner">
    <div class="coordonne_add">
        <p>Supprimer un forum</p>
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
                <button class="add"><i class='bx bx-x-circle'></i><span>Supprimer</span></button>
            </section>
        </form>
        <?php if(array_key_exists("delForum", $_SESSION) and $_SESSION["delForum"] == false): ?>
            <p>Impossible de supprimer le forum, le nom est invalide</p>
        <?php endif; ?>
    </div>
    <div>
        <p>Liste de forums :</p>
        <ul>
            <?php foreach($forums as $forum): ?>
                <li>
                    <p><?php echo $forum->getNom(); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div> -->

<div class="userpage_contenu_inner">
    <div class="coordonne_add">
        <p>Supprimer un forum</p>
        <form action="" method="post" class="coordonne_add">
            <section>
                <label for="nom_forum">Forums :</label>
                <select name="nom_forum" id ="nom_forum">
                    <option value="">--Veuillez sélectionner un forum--</option>
                    <?php foreach($forums as $forum): ?>
                            <option value="<?php echo $forum->getNom(); ?>"> <?php echo $forum->getNom(); ?> </option>
                    <?php endforeach; ?> 
                </select>
            </section>
            <section>
                <button class="add"><i class='bx bx-plus-circle icon_add'></i><span>Delete</span></button>
            </section>
        </form>
    </div>
</div>