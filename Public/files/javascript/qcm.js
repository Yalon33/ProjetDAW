let numQuest = 0;
let nbQuest = 0;

$(document).ready(() => {
});

function chargeQuestionXML(questions){
    $.ajax({
        //chargement du fichier xml
        type: "GET",
        async: false,
        url: questions,
        datatype: "xml",
        success: function(xml){
            //recuperation des informations
            $(xml).find('question').each(
                function(){
                    //var contenu = $(this).text();
                    //$("questions").html(contenu);

                    var idquest = $(this).attr('id');
                    $("questions").append(`<question id="${idquest}">`);
                    var intit = $(this).find('intitulee').text();
                    //ecriture dans html
                    $(`question`).append(`<intitulee>`);
                    $(`question#${idquest} intitulee`).append(intit);
                    $(`question`).append(`</intitulee>`);

                    
                    $(`question`).append(`<reponses>`);

                    $(xml).find(`question#${idquest} reponses reponse`).each(
                        function(){
                            var idrep = $(this).attr('id');
                            var rep = $(this).text();

                            var reponse = $(`<reponse id="${idrep}"><input id="${idquest}.${idrep}" name="${idquest}.${idrep}" value="${rep}" type="checkbox">${rep}</reponse>`);
                            $(`question#${idquest} reponses`).append(reponse);
                        }
                    )
                    $(`question`).append(`</reponses>`);
                    $("questions").append(`</question>`);
                }
            )
        },
        error: function(a, b){
            console.log("Une erreur est survenue");
            console.log(a);
            console.log(b);
        }
    });
}

function verifReponses(bonneReponse, reponse){
    var score = 0;
    var nbQuest = 0;
    $(`reponse`).css("color","red");

    $.ajax({
        type: "GET",
        async: false,
        url: reponse,
        datatype: 'xml',
        success: function(xml){
            //recuperation des informations
            console.log("Par là");
            $('#1.11').prop("checked", true);
            console.log("Par ici");
            $(xml).find('question').each(
                function(){
                    console.log("dans les questions")
                    var idquest = $(this).attr('id');
                    $(this).find(`reponse`).each(
                        function(){
                            var idrep = $(this).attr('id');
                            console.log("Check ici");
                        }
                    )
                }
            )
        },
        error: function(a, b){
            console.log("Une erreur est survenue");
            console.log(a);
            console.log(b);
        }
    });
    $.ajax({
        //chargement du fichier xml
        type: "GET",
        async: false,
        url: bonneReponse,
        datatype: 'xml',
        success: function(xml){
            //recuperation des informations
            $(xml).find('question').each(
                function(){
                    nbQuest++;

                    var touteReponseBonne = true;
                    var idquest = $(this).attr('id');

                    $(this).find(`reponse`).each(
                        function(){
                            var idrep = $(this).attr('id');

                            $(`#${idrep}`).css("color","green");

                            if(document.getElementById(`${idquest}.${idrep}`).checked == false){
                                touteReponseBonne = false;
                            }
                        }
                    )
                    if(touteReponseBonne == true){
                        score++;
                    }
                }
            )
        },
        error: function(a, b){
            console.log("Une erreur est survenue");
            console.log(a);
            console.log(b);
        }
    });
    $(`.qcm_vue`).append(`<h2>Note : ${score}/${nbQuest}</h2>`);
    $(`#validButton`).prop("disabled",true);
}