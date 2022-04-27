<div class="homepage_grid_card">
    <ul class="grid_card">
        <?php foreach ($liste_cycle as $cycle): ?>
        <li class="homepage_card">
            <p class="title_homepage_card"><?php echo $cycle?> :</p>
            <ul class="list_lesson">
            <?php 
                    foreach ($data as $matiere)
                    {
                        if(strcmp(Niveau::toString($matiere[0]->getNiveau()),$cycle)==0)
                        {
                            echo "<li class=lesson>
                                <a href=matieres/".$matiere[0]->getId().">
                                    <span class=date>".$matiere[0]->getDateCreation()."</span>
                                    <div class=image_lesson>
                                        <img src=".$matiere[0]->getImage()."class=image>
                                    </div>
                                    <div class=titre_lesson>
                                        <h3>".$matiere[0]->getNom()."</h3>
                                        <p class=prof>".$matiere[1]->getNom()."</p>
                                    </div>
                                    <div class=card_icon>
                                        <i class='bx bx-heart'></i>
                                        <i class='bx bx-layer-plus' ></i>
                                    </div>
                                </a>
                            </li>";
                        }
                    }
            ?>
            </ul>
        </li>
        <?php endforeach ?>
    </ul>
</div>
<div class="admin_part">
                <div class="btn_add">
                    <button class="btn_add"><i class='bx bx-folder-plus'></i><span>Ajoute une matière</span></button>
                </div>
                <div class="admin_form form_width">
                    <form action="" method="post">
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
                            <button><i class='bx bx-plus-circle icon_add'></i></button>
                        </section>
                    </form>
                    <!-- <button><i class='bx bx-x-circle icon_close'></i></button> -->
                </div>
            </div>
<div class="footer"></div>