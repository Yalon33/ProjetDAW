
<div class="homepage_grid_card">
    <ul class="grid_card">
        <li class="homepage_card">
            <p class="title_homepage_card">Licence 3 :</p>
            <ul class="list_lesson">
            <?php require_once("Src/Modele/matiereDAO.php");
                    require_once("Src/Modele/utilisateurDAO.php");
                    foreach (MatiereDAO::getAll() as $matiere)
                    {
                        if(strcmp(Niveau::toString($matiere->getNiveau()),"L3")==0)
                        {
                            echo "<li class=lesson>
                                <a href=/page=".$matiere->getNom()."/lessons>
                                    <span class=date>".$matiere->getDateCreation()."</span>
                                    <div class=image_lesson>
                                        <img src=".$matiere->getImage()."class=image>
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
            <ul class="list_lesson">
            <?php 
                    foreach (MatiereDAO::getAll() as $matiere)
                    {
                        if(strcmp(Niveau::toString($matiere->getNiveau()),"L2")==0)
                        {
                            echo "<li class=lesson>
                                <a href=/page=".$matiere->getNom()."/lessons>
                                    <span class=date>".$matiere->getDateCreation()."</span>
                                    <div class=image_lesson>
                                        <img src=".$matiere->getImage()."class=image>
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
            <ul class="list_lesson">
            <?php 
                    foreach (MatiereDAO::getAll() as $matiere)
                    {
                        if(strcmp(Niveau::toString($matiere->getNiveau()),"L1")==0)
                        {
                            echo "<li class=lesson>
                                <a href=/page=".$matiere->getNom()."/lessons>
                                    <span class=date>".$matiere->getDateCreation()."</span>
                                    <div class=image_lesson>
                                        <img src=".$matiere->getImage()."class=image>
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
<div class="footer"></div>
<script src="files/javascript/homepage.js"></script>