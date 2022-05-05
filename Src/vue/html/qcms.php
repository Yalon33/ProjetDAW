<div class="qcms">
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