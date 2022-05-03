<div class="qcm_contenu">
    <div id="title">
        <p class="titre_lesson">Titre de cours <span class="nom_prof">Nom de prof</span> </p>
    </div>
    <script>chargeQuestionXML(<?php echo "'../files/QCM/Question/".$qcm->getQuestions()."'"; ?>);</script>
    <?php if(!is_null($reponse)): ?>
        <script>verifReponses(<?php echo "../files/QCM/Reponse/".$correction->getXML().", ../files/QCM/Reponse/".$reponse->getXML(); ?>);</script>
    <?php endif; ?>
    <form method="post" class="qcm_vue">
        <questions>
        </questions>
        <button id='validButton' onclick="verifReponses(<?php echo $correction->getXML().','.$reponse->getXML(); ?>)">Valider</button>
    </form>
</div>