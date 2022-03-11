var numQuest = 0;
var nbQuest = 0;

$(document).ready(() => {
    chargeQuestion();
    changeQuestion();

});

function chargeQuestion(){
    $.getJSON('./questions.json', (data) => {
        nbQuest = data.Questions.length;
        console.log(nbQuest);
        $("#numQuestion").text(data.Questions[numQuest].numero);
        $("#intituleQuestion").text(data.Questions[numQuest].intitulee);
        $("#Reponse1").text(data.Questions[numQuest].reponse1);
        $("#Reponse2").text(data.Questions[numQuest].reponse2);
        $("#Reponse3").text(data.Questions[numQuest].reponse3);
        $("#Reponse4").text(data.Questions[numQuest].reponse4);
    });
}

function changeQuestion(){
    $("i[class='bx bxs-right-arrow']").click(() =>{
        if(numQuest<nbQuest-1){
            numQuest++;
            chargeQuestion();
        }
    });
    $("i[class='bx bxs-left-arrow']").click(() =>{
        if(numQuest>0){
            numQuest--;
            chargeQuestion();
        }
    });
}