<div class="sub_sidebar">
    <div class="logo">
        <div class="image_logo">
            <img src="../files/image/site_logo.png" alt="" class="image_logo">
        </div>
        <p class="titre">Prépa Cours</p>
    </div>
    <div class="user">
        <a href="">
            <div class="user_avatar">
                <img src="../files/image/<?php echo $_SESSION['user']->getImage() ?>" alt="" class="image_avatar"> 
            </div>
            <p class="user_name"><?php echo $_SESSION['user']->getLogin() ?></p>
        </a>
    </div>
</div>