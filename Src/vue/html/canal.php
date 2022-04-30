<div class="talkpage_inner">
    <p class="titre_lesson"><?php  echo $f->getNom()?> <span class="nom_prof"><?php  echo $c->getNom()?></span> </p>
    <div class="window_talk">
            <ul class="window_talk_inner">
            <?php foreach ($m as $message): ?>
                
                <?php if ($message->getIdAuteur() != $_SESSION['user']->getId()) :?>
                    <li class="paralle">
                        <div class=message_paralle>
                            <div class=message_image>
                                <p class=auteur_text_paralle><?php echo $u[$message->getId()]->getLogin()?></p>
                                <img src="../files/image/cuteduck.jpg">
                                <!-- <img src="../files/image/<?php echo $u[$message->getId()]->getImage()?>"> -->
                            </div>
                            <p class=message_text_paralle><?php echo $message->getContenu()?></p>
                        </div>
                    </li>
                <?php else : ?>  
                    <li class="inverse">
                        <div class=message>
                            <div class=message_image>
                                <p class="auteur_text"><?php echo $u[$message->getId()]->getLogin()?></p>
                                <img src="../files/image/cuteduck.jpg">
                                <!-- <img src="../files/image/<?php echo $u[$message->getId()]->getImage()?>"> -->
                            </div>
                            <p class=message_text><?php echo $message->getContenu()?></p>
                        </div>
                    </li> 
                <?php endif?>
            <?php endforeach ?>
            </ul>
                <div class="enter_message">
                        <div class="enter_message_inner">
                            <div class="widow_talk_icon">
                                <i class='bx bx-link' ></i>
                                <i class='bx bx-photo-album' ></i>
                            </div>
                            <form class="message_box" action="" method="post">
                                <input type="hidden" name="auteur_message" id="auteur_message" value="<?php echo $u[$message->getId()]->getLogin() ?>">
                                <input type="hidden" name="auteur_image" id="auteur_image" value="<?php echo $u[$message->getId()]->getImage() ?>">
                                <input type="text" name="message" id="message" placeholder="Envoyer un message">
                            </form> 
                            <button class="btn_send"><i class='bx bx-send' ></i></button>
                        </div>
                    </div>
                </div>
            </div>
</div>
