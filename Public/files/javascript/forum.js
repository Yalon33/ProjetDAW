const btn_add_lesson = document.querySelector("div.btn_add"),
        admin_part = document.querySelector(".admin_form"),
        icon_add = document.querySelector("i.btn_add_item"),
        icon_close = document.querySelector(".btn_close"),
        ul_liste_forum = document.querySelector(".liste_forum");

function toggle_form()
    {
            admin_part.classList.toggle("form_width"); 
    }
        
btn_add_lesson.addEventListener("click",toggle_form);
icon_close.addEventListener("click",toggle_form);
admin_part.addEventListener('click',function(e)
{
    if(e.target == e.currentTarget)
    {
        toggle_form();
    }
});
icon_add.addEventListener("click",()=>
{
    var nom_forum =document.querySelector("#nom_forum");
    if(nom_forum.value.length !=0)
    {
        li_element = document.createElement("li");
        li_element.classList = "item_forum";
    
        p_titre_forum = document.createElement("p");
        p_titre_forum.classList ="titre_forum";
        p_titre_forum.innerText = nom_forum.value.toString();
    
        liste_canal = document.createElement("ul");
        liste_canal.classList="liste_canal";

        li_element.appendChild(p_titre_forum);
        li_element.appendChild(liste_canal);

        ul_liste_forum.appendChild(li_element);

        nom_forum.value="";
        toggle_form();
    }
    else
    {
        alert("Complétez-vous !!");
    }
    // a = document.createElement("a");
    // a.href="/canal"

    // p_titre_canal = document.createElement("p");
    // p_titre_canal.classList = "contenu";

    // p_createur_canal = document.createElement("p");
    // p_createur_canal.classList = "createur_canal";




});