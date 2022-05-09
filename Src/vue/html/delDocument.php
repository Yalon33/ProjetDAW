<!-- <div class="userpage_contenu_inner">
    <div class="coordonne_add">
        <p>Supprimer un document</p>
        <form action="" method="post" class="coordonne_add">
            <section>
                <label for="nom_form">Nom du document : </label>
                <input type="text" name="nom_form" id="nom_form" />
            </section>
            <section>
                <button class="add"><i class='bx bx-x-circle'></i><span>Supprimer</span></button>
            </section>
        </form>
        <?php if(array_key_exists("delDocument", $_SESSION) and $_SESSION["delDocument"] == false): ?>
            <p>Impossible de supprimer le document, le nom est invalide</p>
        <?php endif; ?>
    </div>
    <div>
        <p>Liste des documents :</p>
        <ul>
            <?php foreach($documents as $d): ?>
                <li>
                    <p><?php echo $d->getURI(); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div> -->

<div class="userpage_contenu_inner">
    <div class="coordonne_add">
        <p>Supprimer un document</p>
        <form action="" method="post" class="coordonne_add">
            <section>
                <label for="nom_matiere">Nom de matière: </label>
                <input type="text" name="nom_matiere" id="nom_matiere" value="<?php  echo $matiere->getNom(); ?>" readonly="readonly"/>
            </section>
            <section>
                <label for="nom_document">Liste des documents :</label>
                <select name="nom_document" id ="nom_document">
                    <option value="">--Veuillez sélectionner un forum--</option>
                    <?php foreach($documents as $document): ?>
                            <option value="<?php echo $document->getURI(); ?>"> <?php echo $document->getURI(); ?> </option>
                    <?php endforeach; ?> 
                </select>
            </section>
            <section>
                <label for="nom_createur">Nom de créateur : </label>
                <input type="text" name="nom_createur" id="nom_createur" value="<?php  echo $createur->getNom()?>" readonly="readonly"/>
            </section>
            <section>
                <button class="add"><i class='bx bx-x-circle icon_add'></i><span>Delete</span></button>
            </section>
        </form>
    </div>
</div>