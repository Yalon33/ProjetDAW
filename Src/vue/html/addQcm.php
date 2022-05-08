<div class="userpage_contenu_inner">
    <div class="coordonne_add">
        <p>Ajouter un QCM</p>
        <form action="" method="post" class="coordonne_add">
            <section>
                <label for="qcm_form">QCM</label>
                <input type="file" name="qcm_form" id="qcm_form" accept=".xml" required>   
            </section>
            <?php if(array_key_exists("newQcm", $_SESSION) and $_SESSION["newQcm"] == false): ?>
                <section>Impossible de créer ce qcm, veuillez vérifier les champs</section>
            <?php unset($_SESSION["newQcm"]); endif; ?>
            <section>
                <button class="add"><i class='bx bx-plus-circle icon_add'></i><span>Ajouter</span></button>
            </section>
        </form>
    </div>
</div>