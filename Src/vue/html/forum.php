<div class="forum_contenu">
<p class="titre_lesson">Forum</p>
<?php if(array_key_exists('newCanal', $_SESSION)): ?>
    <p class="titre_lesson">Nouveau canal créé</p>
<?php unset($_SESSION['newCanal']); endif; ?>
<?php if(array_key_exists('newForum', $_SESSION)): ?>
    <p class="titre_lesson">Nouveau forum créé</p>
<?php unset($_SESSION['newForum']); endif; ?>
    <div class="forum_inner">
        <ul class="liste_forum">
        <?php foreach ($arrayForum as $forum): ?>
            <li class=item_forum>
                <p class=titre_forum><?php echo $forum->getNom() ?></p>
                <ul class=liste_canal>
                    <?php if (!empty($arrayCanal[$forum->getId()])):
                        foreach ($arrayCanal[$forum->getId()] as $canal): ?>
                            <li class=item_canal>
                                <a href=/canal/<?php echo $canal->getId() ?>>
                                    <p class=contenu><?php echo $canal->getNom() ?></p>
                                    <p class=createur_canal> Crée par : <?php echo UtilisateurDAO::getById(intval($canal->getIdCreateur()))->getNom() ?></p>
                                </a>
                            </li>
                        <?php endforeach;
                    endif; ?>
                        <li class="item_btn_add">
                            <button class="btn_add_canal"><?php echo "<a href=/addCanal/".$forum->getId().">" ?> <i class='bx bx-message-alt-add'></i><span>Ajoute un canal</span></a></button>
                            <?php if($_SESSION['user']->getType() == TypeUtilisateur::PROFESSEUR): ?>
                            <button class="btn_del_canal"><?php echo "<a href=/delCanal/".$forum->getId().">" ?> <i class='bx bx-message-alt-x'></i><span>Supprimer un canal</span></a></button>
                            <?php endif; ?>
                        </li>
                   

                
                </ul>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php if($_SESSION['user']->getType() == TypeUtilisateur::PROFESSEUR): ?>
        <div class="admin_part">
            <div class="btn_add">
                <button class="btn_add"><a href="/addForum"><i class='bx bx-folder-plus'></i><span>Ajouter un forum</span></a></button>
            </div>
            <div class="btn_del">
                <button class="btn_del"><a href="/delForum"><i class='bx bx-folder-minus'></i><span>Supprimer un forum</span></a></button>
            </div>
        </div>
    <?php endif; ?>
</div>