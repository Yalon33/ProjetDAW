<div class="homepage_grid_card">
    <ul class="grid_card">
        <li class="homepage_card">
            <p class="title_homepage_card">Licence 3 :</p>
            <ul class="list_lesson licence3">
            <?php require_once("Src/Modele/matiereDAO.php");
                    require_once("Src/Modele/utilisateurDAO.php");
                    foreach (MatiereDAO::getAll() as $matiere)
                    {
                        if(strcmp(Niveau::toString($matiere->getNiveau()),"L3")==0)
                        {
                            echo "<li class=lesson>
                                <a href=index.php?page=lessonpage>
                                    <span class=date>".$matiere->getDateCreation()."</span>
                                    <div class=image_lesson>
                                        <img src=files/image/".$matiere->getImage()." class=image>
                                    </div>
                                    <div class=titre_lesson>
                                        <h3>".$matiere->getNom()."</h3>
                                        <p class=prof>".(UtilisateurDAO::getById(intval($matiere->getIdCreateur())))->getNom()."</p>
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
        <li class="homepage_card">
            <p class="title_homepage_card">Licence 2 :</p>
            <ul class="list_lesson licence2">
            <?php 
                    foreach (MatiereDAO::getAll() as $matiere)
                    {
                        if(strcmp(Niveau::toString($matiere->getNiveau()),"L2")==0)
                        {
                            echo "<li class=lesson>
                                <a href=index.php?page=lessonpage>
                                    <span class=date>".$matiere->getDateCreation()."</span>
                                    <div class=image_lesson>
                                        <img src=files/image/".$matiere->getImage()." class=image>
                                    </div>
                                    <div class=titre_lesson>
                                        <h3>".$matiere->getNom()."</h3>
                                        <p class=prof>".(UtilisateurDAO::getById(intval($matiere->getIdCreateur())))->getNom()."</p>
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
        <li class="homepage_card">
            <p class="title_homepage_card">Licence 1 :</p>
            <ul class="list_lesson licence1">
            <?php 
                    foreach (MatiereDAO::getAll() as $matiere)
                    {
                        if(strcmp(Niveau::toString($matiere->getNiveau()),"L1")==0)
                        {
                            echo "<li class=lesson>
                                <a href=index.php?page=lessonpage>
                                    <span class=date>".$matiere->getDateCreation()."</span>
                                    <div class=image_lesson>
                                        <img src=files/image/".$matiere->getImage()." class=image>
                                    </div>
                                    <div class=titre_lesson>
                                        <h3>".$matiere->getNom()."</h3>
                                        <p class=prof>".(UtilisateurDAO::getById(intval($matiere->getIdCreateur())))->getNom()."</p>
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
    </ul>
</div>
<div class="admin_part">
                <div class="btn_add">
                    <button class="btn_add"><i class='bx bx-folder-plus'></i><span>Ajoute une matière</span></button>
                </div>
                <div class="admin_form form_width">
                    <form>
                        <section>
                            <label for="cycle">Cycle : </label>
                            <input type="text" name="cycle" id="cycle" placeholder="Licence..."/>
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
                            <label for="prof_form">Nom de professeur : </label>
                            <input type="text" name="prof_form" id="prof_form" />
                        </section>
                        <section>
                            <i class='bx bx-plus-circle icon_add'></i>
                            <i class='bx bx-x-circle icon_close'></i>
                        </section>
                    </form>
                </div>
            </div>
<div class="footer"></div>