<div class="userpage_contenu_inner">
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
</div>