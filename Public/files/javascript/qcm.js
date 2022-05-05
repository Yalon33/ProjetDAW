$(document).ready(() => {
    chargeQuestionXML()
});

function chargeQuestionXML(){
    $.ajax({
        //chargement du fichier xml
        type: "GET",
        async: false,
        url: $(".qcm").text(),
        datatype: "xml",
        success: function(xml){
            //recuperation des informations
            $(xml).find('question').each(
                function(){
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
                            var reponse = $(`<reponse id="${idrep}"><input id="${idquest}-${idrep}" name="${idquest}-${idrep}" value="${rep}" type="checkbox">${rep}</reponse>`);
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
    if($(".reponse").length != 0){
        $.ajax({
            type: "GET",
            async: false,
            url: $(".reponse").text(),
            datatype: 'xml',
            success: function(xml){
                //recuperation des informations
                $(xml).find('question').each(
                    function(){
                        var idquest = $(this).attr('id');
                        $(this).find(`reponse`).each(
                            function(){
                                var idrep = $(this).attr('id');
                                $(`#${idquest}-${idrep}:checkbox`).prop("checked", true);
                            }
                        )
                    }
                )
                verifReponses("ok");
            },
            error: function(a, b){
                console.log("Une erreur est survenue");
                console.log(a);
                console.log(b);
            }
        });
    }
}

function verifReponses(reponse){
    var score = 0;
    var nbQuest = 0;
    if($('.qcm').text() != "../files/QCM/Question/evaluation.xml"){
        $(`reponse`).css("color","red");
        //Coloration des bonnes réponses
        $.ajax({
            //chargement du fichier xml
            type: "GET",
            async: false,
            url: $(".correction").text(),
            datatype: 'xml',
            success: function(xml){
                //recuperation des informations
                $(xml).find('question').each(
                    function(){
                        var idquest = $(this).attr('id');
                        $(this).find(`reponse`).each(
                            function(){
                                var idrep = $(this).attr('id');
                                $(`#${idrep}`).css("color","green");
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
        //Attribution des points si la réponse est correct
        $(".form_qcm").find('question').each(
            function(){
                var correct = true;
                nbQuest++;
                var idQ = $(this).attr("id");
                $(this).find("reponse").each(
                    function(){
                        var idrep = $(this).attr('id');
                        if(($(`#${idQ}-${idrep}`).is(":checked") == true && $(this).css("color") == "rgb(255, 0, 0)") || ($(`#${idQ}-${idrep}`).is(":checked") == false && $(this).css("color") == "rgb(0, 128, 0)")){
                            correct = false;
                        }
                    }
                )
                if(correct){
                    score++;
                }
            }
        )
        $(`.form_qcm`).append(`<h2>Note : ${score}/${nbQuest}</h2>`);
    }
    $(`#validButton`).prop("disabled",true);
}