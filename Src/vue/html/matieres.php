<div class="homepage_grid_card">

    <ul class="grid_card">
        <li class="homepage_card">
        <p class="title_homepage_card">Les matières suivies :</p>
        <?php if(array_key_exists('newMatiere', $_SESSION)): ?>
            <p class="title_homepage_card">Matière créée</p>
        <?php unset($_SESSION['newMatiere']); endif; ?>
            <ul class="list_lesson">
                <?php foreach($data as $d): ?>
                    <li class="lesson">
                        <a href="matieres/<?php echo $d[0]->getId() ?>">
                            <span class="date"><?php echo $d[0]->getDateCreation() ?></span>
                            <div class="image_lesson">
                                <img src="files/image/<?php echo $d[0]->getImage();?>" class="image">
                            </div>
                            <div class="titre_lesson">
                                <h3><?php echo $d[0]->getNom() ?></h3>
                                <p class="prof"><?php echo $d[2]->getprenom()." ".$d[2]->getNom() ?></p>
                                <span class="avancement"><?php echo $d[1] ?></span>
                            </div>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </li>
        <li>
            <p class="title_homepage_card">Matiere recommendée :</p>
            <?php if(!empty($matiereRecommendee)): ?>
                <ul class="list_lesson">
                    <?php foreach ($matiereRecommendee as $matiere): ?>
                        <li class=lesson>
                            <a href=matieres/<?php echo $matiere[0]->getId(); ?>>
                                <span class=date><?php echo $matiere[0]->getDateCreation(); ?></span>
                                <div class=image_lesson>
                                    <img src="files/image/<?php echo $matiere[0]->getImage(); ?>" class=image>
                                </div>
                                <div class="titre_lesson">
                                    <h3><?php echo $matiere[0]->getNom(); ?></h3>
                                    <p class=prof><?php echo $matiere[1]->getNom(); ?></p>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
         </li>
    </ul>
</div>
<?php if($_SESSION['user']->getType() == TypeUtilisateur::PROFESSEUR): ?>
    <div class="admin_part">
        <div class="btn_add">
            <button class="btn_add"><a href="/addMatiere"><i class='bx bx-folder-plus'></i><span>Ajoute une matière</span></a></button>
        </div>
        <div class="btn_add">
            <button class="btn_del"><a href="/delMatiere"><i class='bx bx-folder-minus'></i><span>Supprimer une matière</span></a></button>
        </div>
    </div>
<?php endif; ?>
<div class="footer"></div>