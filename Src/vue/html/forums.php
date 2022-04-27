<div class="forum_contenu">
<p class="titre_lesson">Forum <span class="nom_prof">discussion</span> </p>
    <div class="forum_inner">
        <ul class="liste_forum">
        <?php foreach (ForumDAO::getAll() as $forum): ?>
            <li class=item_forum>
                <p class=titre_forum><?php echo $forum->getNom() ?></p>
                <ul class=liste_canal>
                <?php foreach (CanalDAO::getAll() as $canal): ?>
                    <?php if($canal->getIdForum() == $forum->getId()): ?>
                    <li class=item_canal>
                            <a href=/canal/<?php echo $canal->getId() ?>>
                                <p class=contenu><?php echo $canal->getNom() ?></p>
                                <p class=createur_canal> Crée par : <?php echo UtilisateurDAO::getById(intval($canal->getIdCreateur()))->getNom() ?></p>
                        </a>
                    </li>
                    <?php endif ?>
                <?php endforeach ?>
                    <li class="item_btn_add">
                        <button class="btn_add_canal"><i class='bx bx-message-alt-add'></i>Ajoute un canal</button>
                    </li>
                </ul>
            </li>
        <?php endforeach ?>
        </ul>
    </div>
    <div class="admin_part">
                    <div class="btn_add">
                        <button class="btn_add"><i class='bx bx-folder-plus'></i><span>Ajoute un forum</span></button>
                    </div>
                    <div class="admin_form form_width">
                        <form>
                            <section class="forum" >
                                <label for="nom_forum">Nom de forum : </label>
                                <input type="text" name="nom_forum" id="nom_forum" />
                            </section>
                            <section class="bouton">
                                <i class='bx bx-plus-circle btn_add_item'></i>
                                <i class='bx bx-x-circle btn_close'></i>
                            </section>
                        </form>
                    </div>
    </div>
</div>