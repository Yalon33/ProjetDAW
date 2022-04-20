<div class="userpage_contenu_inner">
    <ul class="user_coordonne">
        <li>
            <div class="coordonne">
                <p>Informations</p>
                <form class="coordonne">
                    <section>
                        <label for="id_user">ID :</label>
                        <input type="text" name="id_user" value="<?php echo $user->getId(); ?>" id="id_user" readonly="readonly">
                    </section>
                    <section>
                        <label for="login_user">Login :</label>
                        <input type="text" name="name_user" value="<?php echo $user->getLogin(); ?>" id="name_user">
                    </section>
                    <section>
                        <label for="password_user">Mot de passe :</label>
                        <input type="password" name="password_user" value="<?php echo $user->getMdp(); ?>" id="password_user">
                    </section>
                    <section>
                        <label for="mail_user">Mail :</label>
                        <input type="text" name="mail_user" value="<?php echo $user->getMail(); ?>" id="mail_user">
                    </section>
                    <section>
                        <label for="prenom_user">Prenom :</label>
                        <input type="text" name="prenom_user" value="<?php echo $user->getPrenom(); ?>" id="prenom_user">
                    </section>
                    <section>
                        <label for="nom_user">Nom :</label>
                        <input type="text" name="nom_user" value="<?php echo $user->getNom(); ?>" id="nom_user">
                    </section>
                    <section>
                        <label for="type_user">Type :</label>
                        <input type="text" name="type_user" value="<?php echo TypeUtilisateur::toString($user->getType()); ?>" id="type_user">
                    </section>
                    <section>
                        <label for="image_user">Image :</label>
                        <input type="text" name="image_user" id="image_user">
                    </section>
                </form>
            </div>
        </li>
    </ul>
</div>

<button><i class='bx bx-sync'></i>Update</button>  
<script src="files/javascript/userpage.js"></script>