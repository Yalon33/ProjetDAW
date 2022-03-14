var numQuest = 0;
var nbQuest = 0;

$(document).ready(() => {
    chargeQuestion();
    changeQuestion();

});

function suppReponses(){
    $(".reponses").remove();
}

function chargeQuestion(){
    $.getJSON('../javascript/questions.json', (data) => {
        nbQuest = data.Questions.length;
        let q = data.Questions[numQuest];
        $("#numQuestion").text(q.numero);
        $("#intituleQuestion").text(q.intitulee);

        console.log(q.Reponses.length);

        for(let i=0; i<q.Reponses.length; i++){
            const reponse = $(`<li class="reponses"><input type="checkbox">${i+1} : ${q.Reponses[i].reponse}</li>`);
            if(i%2 == 0){
                $(".reponsesimpair").append(reponse);
            }
            else{
                $(".reponsespair").append(reponse);
            }
        }
    });
}

function changeQuestion(){
    $("i[class='bx bxs-right-arrow']").click(() =>{
        if(numQuest<nbQuest-1){
            numQuest++;
            suppReponses();
            chargeQuestion();
        }
    });
    $("i[class='bx bxs-left-arrow']").click(() =>{
        if(numQuest>0){
            numQuest--;
            suppReponses();
            chargeQuestion();
        }
    });
}

const icon_menu= document.querySelector(".icon_toggle"),
        nav= document.querySelector("nav"),
        body=document.querySelector("body"),
        toggle_switch=document.querySelector(".toggle-switch");

icon_menu.addEventListener("click",() =>
{
    nav.classList.toggle("menu_sidebar");
});
toggle_switch.addEventListener("click",() =>
{
    body.classList.toggle("dark");
});