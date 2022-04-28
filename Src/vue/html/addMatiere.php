<div class="admin_form form_width">
                    <form action="" method="post">
                        <section>
                            <label for="niveau_matiere">Cycle :</label>
                            <select name="niveau_matiere" id ="niveau_matiere">
                                
                                <option value="">--Please choose an option--</option>
                                <?php 
                                    require_once("Src/Controleur/niveau.php");
                                    
                                    foreach(Niveau::cases() as $niveau)
                                    {
                                        echo "<option value=$niveau->name>$niveau->name</option>";
                                    }
                                ?> 
                          </select>
                        </section>
                        <section>
                            <label for="image_form">URL d'image : </label>
                            <input type="text" name="image_form" id="image_form" />
                        </section>
                        <section>
                            <label for="lesson_form">Nom de matière : </label>
                            <input type="text" name="lesson_form" id="lesson_form" />
                        </section>
                        <section>
                            <button><i class='bx bx-plus-circle icon_add'></i></button>
                        </section>
                    </form>
                    <!-- <button><i class='bx bx-x-circle icon_close'></i></button> -->
                </div>