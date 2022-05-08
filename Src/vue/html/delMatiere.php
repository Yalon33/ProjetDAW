<div class="userpage_contenu_inner">
    <div class="coordonne_add">
        <p>Supprimer une matiere</p>
        <form action="" method="post" class="coordonne_add">
            <section>
                <label for="nom_form">Nom de la matiere : </label>
                <input type="text" name="nom_form" id="nom_form" />
            </section>
            <section>
                <label for="niveau_form">Niveau de la matière : </label>
                <input type="text" name="niveau_form" id="niveau_form">
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
        <p>Liste des matières :</p>
        <ul>
            <?php foreach($matieres as $m): ?>
                <li>
                    <p>Nom du forum: <?php echo $m->getNom(); ?></p>
                    <p>Niveau: <?php echo Niveau::toString($m->getNiveau()); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>