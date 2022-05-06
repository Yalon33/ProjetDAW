function ajoutQuestion(){
    let id = $(".listQuestion li:last-child").length != 0 ? $(".listQuestion li:last-child").attr('id') : 1;
    console.log($(".listQuestion li:last-child").attr('id'))
    id+=1;
    console.log("idQ="+id);
    $(".listQuestion").append(`
    <li id="${id}">
        <label>Question ${id}:</label>
        <input type='text'>
        <ul class="listReponse">
            <li id="${id}">
                <label>Reponse1 :</label>
                <input type="text" id="${id}-${id}1"> 
            </li>
        </ul>
        <button type="button" onclick="ajoutReponse()">Ajouter une réponse</button>
    </li>
    `);
}

function ajoutReponse(){
    var idRep = $(".listReponse li:last-child").length != 0 ? $(".listReponse li:last-child").attr('id') : 1;
    idRep = idRep++;
    $(".listReponse").append(`
    <li id=r"${idRep}">
        <label>Reponse${idRep} :</label>
        <input type='text' id="1-1${idRep}">
    </li>`);
}