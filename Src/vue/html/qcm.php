<div class="qcm_contenu">
    <div id="title">
        <p class="titre_lesson"><?php echo explode(".", $qcm->getQuestions())[0]?><span class="nom_prof"><?php echo " ".$prof->getPrenom()." ".$prof->getNom(); ?></span> </p>
    </div>
    <p hidden class="qcm"><?php echo '../files/QCM/Question/'.$qcm->getQuestions()?></p>
    <p hidden class="correction"><?php echo '../files/QCM/Reponse/'.$correction->getXML()?></p>
    <?php if(!is_null($reponse)): ?>
        <p hidden class="reponse"><?php echo '../files/QCM/Reponse/'.$reponse->getXML()?></p>
    <?php endif; ?>
    <form action="" method="post" class="form_qcm">
        <questions>
        </questions>
        <button id='validButton' onclick="verifReponses(<?php echo $correction->getXML();?>)">Valider</button>
    </form>
</div>