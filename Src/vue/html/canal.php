<div class="talkpage_inner">
    <p class="titre_lesson">Form <span class="nom_prof">discussion</span> </p>
    <div class="window_talk">
        <ul class="window_talk_inner">
        <?php foreach ($m as $message): ?>
            <li>
                <div class=message>
                    <div class=message_image>
                        <img src="../files/image/<?php echo $u[$message->getId()]->getImage()?>">
                    </div>
                    <p class=auteur_text><?php echo $u[$message->getId()]->getLogin()?></p>
                    <p class=message_text><?php echo $message->getContenu()?></p>
                </div>
            </li> 
        <?php endforeach ?>
        </ul>
        <div class="enter_message">
            <div class="enter_message_inner">
                <div class="widow_talk_icon">
                    <i class='bx bx-link' ></i>
                    <i class='bx bx-photo-album' ></i>
                </div>
                <form class="message_box" action="" method="post">
                    <input type="text" name="message" id="message" placeholder="Envoyer un message dans <?php echo $c->getNom() ?>">
                </form> 
                <button class="btn_send"><i class='bx bx-send' ></i></button>
            </div>
        </div>
    </div>
</div>
