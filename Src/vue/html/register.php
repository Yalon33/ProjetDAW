<div class="logo_login">
    <span class="p">P</span>
    <span class="c">C</span>
    <p>Prépa Cours</p>
</div>
<div class="login_image_right">
    <img src="files/image/image_login_5.jpg" alt="" class="image">
    <img src="files/image/image_login_2.jpg" alt="" class="image">
</div>
<div class="login_image_left">
    <img src="files/image/image_login_3.jpg" alt="" class="image">
    <img src="files/image/image_login_4.jpg" alt="" class="image">
</div>
<div class="login">
    <div class="login_inner">
        <div class="login_form">
            <form action="" method="post" enctype="multipart/form-data">
                <section class="login_form">
                    <label for="login_form">Login: </label>
                    <input class="text_input" type="text" name="login_form" id="login_form" required>   
                </section>
                <section class="password_form">
                    <label for="password_form">Mot de passe: </label>
                    <input class="text_input" type="password" name="password_form" id="password_form" required>
                </section>
                <section class="login_form">
                    <label for="login_form">Mail: </label>
                    <input class="text_input" type="text" name="mail_form" id="mail_form" required>   
                </section>
                <section class="login_form">
                    <label for="login_form">Prenom: </label>
                    <input class="text_input" type="text" name="prenom_form" id="prenom_form" required>   
                </section>
                <section class="login_form">
                    <label for="login_form">Nom: </label>
                    <input class="text_input" type="text" name="nom_form" id="nom_form" required>   
                </section>
                <section class="login_form">
                    <label for="type">Type d'utilisateur :</label>
                    <select name="type" id ="type">
                        <option value="">--Veuillez sélectionner une option--</option>
                        <?php foreach($types as $t): ?>
                                <option value=<?php echo TypeUtilisateur::toString($t); ?>> <?php echo TypeUtilisateur::toString($t); ?> </option>
                        <?php endforeach; ?> 
                    </select>
                </section>
                <section>
                    <label for="image_form">Photo de profil: </label>
                    <input type="file" name="image_form" id="image_form" accept=".png,.jpg,.jpeg" required>   
                </section>
                <?php if(!empty($error)): ?>
                    <section>
                        <?php echo "$error"; ?>
                    </section>
                <?php endif; ?>
                <button>Créer un compte</button>
            </form>
        </div>
    </div>
</div>
<div class="modal_create"></div>