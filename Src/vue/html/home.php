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
                    <button class="btn_add"><a href="/addMatiere"><i class='bx bx-folder-plus'></i><span>Ajoute une matière</span></a></button>
                </div>
            </div>
<div class="footer"></div>