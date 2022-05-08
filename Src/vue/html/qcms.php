<div class="qcms">
    <?php if($_SESSION['user']->getType() == TypeUtilisateur::PROFESSEUR): ?>
        <div class="btn_add">
            <button class="btn_add"><a href="/addQcm"><i class='bx bx-folder-plus'></i><span>Ajouter un QCM</span></a></button>
        </div>
    <?php endif; ?>
    <p class="titre_lesson">QCM</p>
    <ul>
        <?php foreach($qcm as $q):?>
            <li class="lesson">
                <a href="qcm/<?php echo $q->getId() ?>">
                    <div class="nomQCM">
                        <p class="nom"><?php echo explode(".", $q->getQuestions())[0]; ?></p>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>