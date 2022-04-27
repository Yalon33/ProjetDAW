<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../css/menu.css">
        <link rel="stylesheet" href="../css/qcm.css">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body class="dark">
        <?php include("./menu.html");?>
        <div class="page_contenu">
            <?php include("./banderole.html");?>
            <div class="qcm_contenu">
                <div id="title">
                    <p class="titre_lesson">Titre de cours <span class="nom_prof">Nom de prof</span> </p>
                </div>
                <div class="qcm_vue">
                    <div class="labelQuestion">
                        <h3>Question n°<span id="numQuestion"></span> : <span id="intituleQuestion"></span> </h3>
                        <!-- <p id="intituleQuestion"></p> -->
                    </div>
                    <div class="propositionReponse">
                        <ul class="listeReponses">
                            <li>
                                <ul class="reponsesimpair"></ul>
                            </li>
                            <li>
                                <ul class="reponsespair"></ul>
                            </li>
                        </ul>
                    </div>
                    <div class="change_Question">
                        <i class='bx bxs-left-arrow' ></i>
                        <i class='bx bxs-right-arrow'></i>
                        <!--<button id="last">précédent</button>
                        <button id="next">Suivant</button>-->
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../javascript/qcm.js"></script>
</html>