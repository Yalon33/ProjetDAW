<div class="forum_contenu">
<p class="titre_lesson">Forum <span class="nom_prof">discusion</span> </p>
    <div class="forum_inner">

        <ul class="liste_forum">
        <?php 
            require_once("Src/Modele/messageDAO.php");
            require_once("Src/Modele/utilisateurDAO.php");
            require_once("Src/Modele/forumDAO.php");
            require_once("Src/Modele/canalDAO.php");
            foreach (ForumDAO::getAll() as $forum)
                {
                    echo "<li class=item_forum>";
                    echo "<p class=titre_forum>".$forum->getNom()."</p>";
                    echo "<ul class=liste_canal>";
                    foreach (CanalDAO::getAll() as $canal)
                    {
                        
                        if($canal->getIdForum() == $forum->getId())
                            {
                                echo "
                                    <li class=item_canal>
                                        <a href=/message>
                                                <p class=contenu>".$canal->getNom()."</p>
                                                <p class=createur_canal> Crée par : ".UtilisateurDAO::getById(intval($canal->getIdCreateur()))->getNom()."</p>
                                        </a>
                                    </li>
                              
                                ";
                            }
                        
                    }
                    echo "</ul>";
                    echo "</li>";
                }
        ?>
        </ul>
    </div>
</div>

