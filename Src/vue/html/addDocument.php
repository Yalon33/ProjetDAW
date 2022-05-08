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
                <label for="url_form">URL : </label>
                <input type="text" name="url_form" id="url_form" />
            </section>
            <section >
                <button class="add"><i class='bx bx-plus-circle btn_add_item'></i><span>Ajouter</span></button>
            </section>
        </form>
    </div>
</div>