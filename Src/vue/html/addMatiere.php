<div class="userpage_contenu_inner">
<div class="coordonne_add">
    <p>Ajouter une matière</p>
        <form action="" method="post" class="coordonne_add">
            <section>
                <label for="niveau_matiere">Cycle :</label>
                <select name="niveau_matiere" id ="niveau_matiere">
                    <option value="">--Veuillez sélectionner un niveau--</option>
                    <?php foreach(Niveau::allNiveau() as $niveau): ?>
                            <option value=<?php echo Niveau::toString($niveau); ?>> <?php echo Niveau::toString($niveau); ?> </option>
                    <?php endforeach; ?> 
                </select>
            </section>
            <section>
                <label for="image_form">URL de l'image : </label>
                <input type="text" name="image_form" id="image_form" />
            </section>
            <section>
                <label for="lesson_form">Nom de la matière : </label>
                <input type="text" name="lesson_form" id="lesson_form" />
            </section>
            <section>
            <button class="add"><i class='bx bx-plus-circle icon_add'></i><span>Ajouter</span></button>
            </section>
        </form>
    </div>
</div>