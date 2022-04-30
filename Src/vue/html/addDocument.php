<div class="userpage_contenu_inner">
    <div class="coordonne_add">
        <form action="" method="post" class="coordonne_add">
            <p>Ajouter un document</p>
            <section >
                <label for="nom_form">Nom de matière: </label>
                <input type="text" name="titre_form" id="titre_form" value="<?php echo $m ?>" readonly="readonly" />
            </section>
            <section >
                <label for="createur_form">Créateur: </label>
                <input type="text" name="createur_form" id="createur_form" value="<?php echo $u ?>" readonly="readonly" />
            </section>
            <section >
                <label for="titre_form">Titre de diapos : </label>
                <input type="text" name="titre_form" id="titre_form" />
            </section>
            <section >
                <label for="url_form">URL : </label>
                <input type="text" name="url_form" id="url_form" />
            </section>
            <section >
                <button class="add"><span>Ajouter</span></button>
            </section>
        </form>
        <?php if(array_key_exists("newDocument", $_SESSION) and $_SESSION["newDocument"] == false): ?>
            <p>Impossible d'ajouter ce document, veuillez vérifier tous les champs</p>
        <?php endif; ?>
    </div>
</div>