<div class="talkpage_inner">
    <p class="titre_lesson">Form <span class="nom_prof">discusion</span> </p>
    <div class="window_talk">
            <ul class="window_talk_inner">
            <?php foreach (MessageDAO::getAll() as $message): ?>
                <li>
                    <div class=message>
                        <!--
                            Les images des utilisateurs sont à afficher dans une petite icone en cercle à côté du message pour savoir qui l'a envoyé rapidement (comme sur discord)
                        <div class=message_image>
                            <img src=<?php //echo UtilisateurDAO::getById(intval($message->getIdAuteur()))->getImage() ?>>
                        </div>
                        -->
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
                            <input type="text" name="message" id="message" placeholder="Aa">
                            <button class="btn_send"><i class='bx bx-send' ></i></button>
                        </div>
                    </div>
                </div>
            </div>
</div>
<script src="files/javascript/forums.js"></script>
