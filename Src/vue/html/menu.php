<header>
    <div class="menu_icon">
        <i class='bx bx-menu icon_toggle'></i>
    </div>
</header>
<div class="menu_body">
    <ul class="menu_body">
        <li class="menu_home">
            <a href="/home">
                <i class='bx bx-home' ></i>
                <span class="text_opacity">Home</span>
            </a>
        </li>
        <li class="menu_user">
            <a href="/user">
                <i class='bx bx-user' ></i>
                <span class="text_opacity">User</span>
            </a>
        </li>
        <li class="menu_notif">
            <a href="/forum">
                    <i class='bx bx-conversation'></i>
                    <span class="text_opacity">Forum</span>
            </a>
        </li>
        <?php if($_SESSION['user']->getType() == TypeUtilisateur::ETUDIANT): ?>
            <li class="menu_cours">
                <a href="/matieres">
                    <i class='bx bx-book' ></i>
                    <span class="text_opacity">Matieres</span>
                </a>
            </li>
        <?php endif; ?>
        <li class="menu_qcm">
            <a href="/qcm">
                <i class='bx bx-question-mark'></i>
                <span class="text_opacity">QCM</span>
            </a>
        </li>
    </ul>
</div>
    
<div class="menu_footer">
    <ul class="menu_footer">
        <li class="menu_logout">
            <a href="/logout">
                <i class='bx bx-log-out' ></i>
                <span class="text-mode text_opacity">Log out</span>
            </a>
        </li>
        <li class="menu_mode">
            <a href="#">
                <i class='bx bx-moon'></i>
                <span class="text-mode text_opacity vision_mode">Light Mode</span>
            </a>
            <div class="toggle-switch  text_opacity">
                <span class="switch"></span>
            </div>
        </li>
    </ul>  
</div>
<script src="../files/javascript/menu.js"></script>