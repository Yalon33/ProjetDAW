<div class="userpage_contenu_inner">
    <p>Veuillez Entrer les questions et leurs réponses possible. Le corrigé se fera lorsque vous effectuerez le QCM</p>
    <form action="" method="post" class="formQCM">
        <ul class="listQuestion">
            <li id="1">
                <label>Question1 :</label>
                <input type="text" id="1">
                <ul class="listReponse">
                    <li id="11">
                        <label>Reponse1 :</label>
                        <input type="text" id="1-11">
                    </li>
                </ul>
                <button type="button" onclick="ajoutReponse()">Ajouter une réponse</button>
            </li>
        </ul>
        <button type="button" onclick="ajoutQuestion()">Ajouter une question</button>
        <input type="submit" value="Valider">
    </form>
</div>