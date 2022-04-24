<div class="homepage_grid_card">
<p class="title_homepage_card">Les matières suivies :</p>

    <ul class="list_lesson">
        <?php require_once("Src/Modele/matiereDAO.php");
                require_once("Src/Modele/utilisateurDAO.php");
                require_once("Src/Modele/matiereSuivieDAO.php");
        
        foreach(MatiereDAO::getAll() as $matiere)
        {
            if(MatiereSuivieDAO::getByIdEtuMat($_SESSION['user']->getId(),$matiere->getId()))
            {
                $matiere_suivie = MatiereSuivieDAO::getByIdEtuMat($_SESSION['user']->getId(),$matiere->getId());
                foreach ($matiere_suivie as $x => $s)
                {
                    $m = MatiereDAO::getById($x);
                    echo "<li class=lesson>
                        <a href=/lessons?action=".$m->getId().">
                            <span class=date>".$m->getDateCreation()."</span>
                            <div class=image_lesson>
                                <img src=".$m->getImage()."class=image>
                            </div>
                            <div class=titre_lesson>
                                <h3>".$m->getNom()."</h3>
                                <p class=prof>".(UtilisateurDAO::getById(intval($m->getIdCreateur())))->getNom()."</p>
                            </div>
                            <div class=card_icon>
                                <i class='bx bx-heart'></i>
                                <i class='bx bx-layer-plus' ></i>
                            </div>
                        </a>
                        </li>";
                }

            }
        }
           
                   
            ?>
       
     
    </ul>
</div>
<div class="footer"></div>
<script src="files/javascript/homepage.js"></script>