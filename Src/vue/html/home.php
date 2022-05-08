<div class="homepage_grid_card">
    <?php if($_SESSION['user']->getType() == TypeUtilisateur::PROFESSEUR): ?>
        <div class="btn_del">
            <button class="btn_del"><a href="/delMatiere"><i class='bx bx-folder-minus'></i><span>Supprimer une matière</span></a></button>
        </div>
    <?php endif; ?>
    <ul class="grid_card">
        <?php foreach ($liste_cycle as $cycle): ?>
        <li class="homepage_card">
            <p class="title_homepage_card"><?php echo $cycle?> :</p>
            <ul class="list_lesson">
            <?php foreach ($data as $matiere):
                if(Niveau::toString($matiere[0]->getNiveau()) == $cycle): ?>
                    <li class=lesson>
                        <a href=matieres/<?php echo $matiere[0]->getId(); ?>>
                            <span class=date><?php echo $matiere[0]->getDateCreation(); ?></span>
                            <div class=image_lesson>
                                <img src="files/image/<?php echo $matiere[0]->getImage(); ?>" class=image>
                            </div>
                            <div class=titre_lesson>
                                <h3><?php echo $matiere[0]->getNom(); ?></h3>
                                <p class=prof><?php echo $matiere[1]->getNom(); ?></p>
                            </div>
                        </a>
                        <form action= method=post>
                            <button><i class='bx bx-layer-plus' ></i><button>
                        </form>
                    </li>
                <?php endif;
            endforeach ?>
            </ul>
        </li>
        <?php endforeach ?>
    </ul>
</div>
<div class="footer"></div>