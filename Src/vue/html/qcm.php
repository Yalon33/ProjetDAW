<div class="qcm_contenu">
    <div id="title">
        <p class="titre_lesson"><?php echo explode(".", $qcm->getQuestions())[0]?><span class="nom_prof"><?php echo " ".$prof->getPrenom()." ".$prof->getNom(); ?></span> </p>
    </div>
    <p hidden class="qcm"><?php echo '../files/QCM/Question/'.$qcm->getQuestions()?></p>
    <p hidden class="correction"><?php echo '../files/QCM/Reponse/'.$correction->getXML()?></p>
    <p hidden class="idUtilisateur"><?php echo $_SESSION['user']->getId();?></p>
    <p hidden class="idCreateur"><?php echo $qcm->getIdProf()?></p>
    <?php if($qcm->getIdProf() == $_SESSION['user']->getID()): ?>
    <div class="admin_part">
        <div class="btn_suppr">
            <button class="btn_add"><a href=<?php echo "/delQCM/".$qcm->getId();?>><i class='bx bx-folder-minus'></i><span>Supprimer le QCM</span></a></button>
        </div>
    </div>
    <?php endif;
    if(!is_null($reponse)): ?>
        <p hidden class="reponse"><?php echo '../files/QCM/Reponse/'.$reponse->getXML()?></p>
    <?php endif; ?>
    <form action="" method="post" class="form_qcm">
        <questions>
        </questions>
        <button id='validButton' onclick="verifReponses(null)">Valider</button>
    </form>
</div>