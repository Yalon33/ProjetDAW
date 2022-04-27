<div class="homepage_grid_card">
    <p class="title_homepage_card">Les matières suivies :</p>
    <ul class="list_lesson">
        <?php foreach($data as $d): ?>
            <li class="lesson">
                <a href="matieres/<?php echo $d[0]->getId() ?>">
                    <span class="date"><?php echo $d[0]->getDateCreation() ?></span>
                    <div class="image_lesson">
                        <img src="<?php echo $d[0]->getImage() ?>" class="image">
                    </div>
                    <div class="titre_lesson">
                        <h3><?php echo $d[0]->getNom() ?></h3>
                        <p class="prof"><?php echo $d[2]->getprenom()." ".$d[2]->getNom() ?></p>
                        <span class="avancement"><?php echo $d[1] ?></span>
                    </div>
                    <div class="card_icon">
                        <i class='bx bx-heart'></i>
                        <i class='bx bx-layer-plus' ></i>
                    </div>
                </a>
            </li>
        <?php endforeach ?>
    </ul>
</div>
<div class="footer"></div>