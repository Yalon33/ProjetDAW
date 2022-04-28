<div class="lesson_inner">
    <p class="titre_lesson"><?php echo $m->getNom() ?><span class="nom_prof"><?php echo $p->getPrenom()." ".$p->getNom() ?></span> </p>
    <div class="list_diapos">
        <div class="list_diapos_inner">
            <p class="titre_list_diapos">Documents de cours :</p>
            <ul class="list_diapos" id="diapos">
                <?php foreach($contenus as $c): ?>
                    <li>
                        <div class="list_diapos_item list_item">
                            <img src="../files/image/pdf.png" height="100%" width="100%" style="border-radius:5px ;">
                        </div>
                        <p class="titre_item"><?php echo $c->getUri(); ?></p>
                        <div class="modal_pdf hidden">
                            <i class='bx bx-x icon_close'></i>
                            <div class="pdf">
                                <iframe src="../files/docs/<?php echo $c->getUri()?>" height="100%" width="100%"></iframe> 
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <button class="btn_list_diapos_right"><i class='bx bxs-left-arrow' ></i></button>
        <button class="btn_list_diapos_left"><i class='bx bxs-right-arrow' ></i></button>
        <div class="lessonpage_dark"></div>
        <div class="admin_part">
                    <div class="btn_add">
                        <button class="btn_add"><i class='bx bx-folder-plus'></i><span>Ajoute un document</span></button>
                    </div>
                    <div class="admin_form form_width">
                        <form action="" method="post">
                            <section >
                                <label for="titre_form">Titre de diapos : </label>
                                <input type="text" name="titre_form" id="titre_form" />
                            </section>
                            <section >
                                <label for="url_form">URL : </label>
                                <input type="text" name="url_form" id="url_form" />
                            </section>
                            <section >
                                <button><i class='bx bx-plus-circle btn_add_item'></i></button>
                            </section>
                        </form>
                    </div>
                </div>
    </div>
    

   
<div class="footer"></div>

