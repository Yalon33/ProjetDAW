<div class="userpage_contenu_inner">
<div class="coordonne_add">
    <p>Ajoute un Forum</p>
        <form action="" method="post" class="coordonne_add">
                        <section>
                            <label for="nom_form">Nom de forum : </label>
                            <input type="text" name="nom_form" id="nom_form" />
                        </section>
                        <section>
                            <label for="createur_form">Nom de créateur : </label>
                            <input type="text" name="createur_form" id="createur_form" value="<?php echo $_SESSION['user']->getNom() ?>" readonly="readonly"/>
                        </section>
                        <section>
                            <button class="add"><i class='bx bx-plus-circle icon_add'></i><span>Ajoute</span></button>
                        </section>
                       
                    </form>
    </div>
</div>