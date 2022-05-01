<div class="qcm_contenu">
    <div id="title">
        <p class="titre_lesson">Titre de cours <span class="nom_prof">Nom de prof</span> </p>
    </div>
    <p hidden class="qcm"><?php echo "../files/XML/QCM/".$q->getQuestions(); ?></p>
    <p hidden class="reponse"><?php echo "../files/XML/Reponse/".$r->getXML(); ?></p>
    <form action="" method="post" class="qcm_vue">
        <questions>
        </questions>
        <button id='validButton' onclick="verifReponses()">Valider</button>
    </form>
</div>
<script src="../files/javascript/jquery.js"></script>
<script src="../files/javascript/qcm.js"></script>