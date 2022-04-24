
    <div class="window_talk">
        <ul class=window_talk_inner>
                <?php 
                                foreach (MessageDAO::getAll() as $message)
                                {
                                    echo " <li>
                                            <div class=message>
                                                <div class=message_image>
                                                    <img src=".UtilisateurDAO::getById(intval($message->getIdAuteur()))->getImage().">
                                                </div>
                                                <p class=message_text>".$message->getContenu()."</p>
                                            </div>
                                        </li>
                                    
                                    ";
                                }
                            ?>
                            
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

<script src="files/javascript/message.js"></script>
