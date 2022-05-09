<div class="qcms">
    <?php if($_SESSION['user']->getType() == TypeUtilisateur::PROFESSEUR): ?>
        <div class="btn_add">
            <button class="btn_add"><a href="/addQcm"><i class='bx bx-folder-plus'></i><span>Ajouter un QCM</span></a></button>
        </div>
    <?php endif; ?>
    <p class="titre_lesson">QCM</p>
    <ul class="liste_qcm">
        <?php foreach($data as $q):?>
            <li class="qcm">
                <a href="qcm/<?php echo $q[0]->getId() ?>">
                    <div class="nomQCM">
                        <p class="nom"><?php echo explode(".", $q[0]->getQuestions())[0]; ?></p>
                    </div>
                    <div class="nomCreateur">
                        <p class="nomCreateur">Créateur : <?php echo $q[1]->getNom();?></p>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>