<div class="forum_contenu">
<p class="titre_lesson">Forum <span class="nom_prof">discusion</span> </p>
    <div class="forum_inner">
        <ul class="liste_forum">
        <?php foreach (ForumDAO::getAll() as $forum): ?>
            <li class=item_forum>
                <p class=titre_forum><?php $forum->getNom() ?></p>
                <ul class=liste_canal>
                <?php foreach (CanalDAO::getAll() as $canal): ?>
                    <?php if($canal->getIdForum() == $forum->getId()): ?>
                    <li class=item_canal>
                            <a href=/message>
                                <p class=contenu><?php echo $canal->getNom() ?></p>
                                <p class=createur_canal> Crée par : <?php echo UtilisateurDAO::getById(intval($canal->getIdCreateur()))->getNom() ?></p>
                        </a>
                    </li>
                    <?php endif ?>
                <?php endforeach ?>
                </ul>
            </li>
        <?php endforeach ?>
        </ul>
    </div>
</div>