<div class="userpage_contenu_inner">
<div class="coordonne_add">
    <p>Ajoute une matière</p>
        <form action="" method="post" class="coordonne_add">
                        <section>
                            <label for="niveau_matiere">Cycle :</label>
                            <select name="niveau_matiere" id ="niveau_matiere">
                                
                                <option value="">--Please choose an option--</option>
                                <?php 
                                    require_once("Src/Controleur/niveau.php");
                                    
                                    foreach(Niveau::cases() as $niveau)
                                    {
                                        echo "<option value=$niveau->name>$niveau->name</option>";
                                    }
                                ?> 
                          </select>
                        </section>
                        <section>
                            <label for="image_form">URL d'image : </label>
                            <input type="text" name="image_form" id="image_form" />
                        </section>
                        <section>
                            <label for="lesson_form">Nom de matière : </label>
                            <input type="text" name="lesson_form" id="lesson_form" />
                        </section>
                        <section>
                        <button class="add"><i class='bx bx-plus-circle icon_add'></i><span>Ajoute</span></button>
                        </section>
                    </form>
    </div>
</div>