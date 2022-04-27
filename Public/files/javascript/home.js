/*
const btn_add_lesson = document.querySelector("div.btn_add"),
        admin_part = document.querySelector(".admin_form"),
        icon_add = document.querySelector(".icon_add"),
        icon_close = document.querySelector(".icon_close"),
        ul_licence3 = document.querySelector(".licence3"),
        ul_licence2 = document.querySelector(".licence2"),
        ul_licence1 = document.querySelector(".licence1");

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

icon_add.addEventListener("click",(e)=>
{
    var text_cycle = document.querySelector("#cycle"),
        text_image = document.getElementById("image_form"),
        text_lesson = document.getElementById("lesson_form"),
        text_prof   = document.getElementById("prof_form");
    if(text_cycle.value.length !=0 && text_image.value.length !=0 &&
        text_lesson.value.length !=0 && text_prof.value.length !=0 )
        {
            //Create DOM
            li_element = document.createElement("li");
            li_element.className = "lesson";
            a_element = document.createElement("a");
            a_element.href = "index.php?page=lessonpage";
        
            span_element = document.createElement("span");
            span_element.className = "date";
            var date = new Date();
            span_element.innerText= date.toDateString();

            div_image_element = document.createElement("div");
            div_image_element.className="image_lesson";
            image_element = document.createElement("img");
            image_element.src = text_image.value.toString();
            image_element.className ="image";
            div_image_element.appendChild(image_element);

            div_titre_element = document.createElement("div");
            div_titre_element.className= "titre_lesson";
            h3_titre_element = document.createElement("h3")
            h3_titre_element.innerText= text_lesson.value.toString();
            p_titre_element= document.createElement("p");
            p_titre_element.className = "prof";
            p_titre_element.innerText = text_prof.value.toString();
            div_titre_element.appendChild(h3_titre_element);
            div_titre_element.appendChild(p_titre_element);
        
            div_icon_element = document.createElement("div");
            div_icon_element.className = "card_icon";
            i_heart_element = document.createElement("i");
            i_heart_element.className = "bx bx-heart";
            i_follow_element = document.createElement("i");
            i_follow_element.className = "bx bx-layer-plus";
            div_icon_element.appendChild(i_heart_element);
            div_icon_element.appendChild(i_follow_element);
        
            a_element.appendChild(span_element);
            a_element.appendChild(div_image_element);
            a_element.appendChild(div_titre_element);
            a_element.appendChild(div_icon_element);
        
            li_element.appendChild(a_element);
        
            if(text_cycle.value == "Licence 3" || text_cycle.value == "3" || text_cycle.value == "licence3")
            {
                ul_licence3.appendChild(li_element);
                admin_part.classList.toggle("form_width");  
                text_cycle.value ="";
                text_image.value="";
                text_lesson.value="";
                text_cycle.value="";
            }
            else if(text_cycle.value == "Licence 2" || text_cycle.value == "2" || text_cycle.value == "licence2")
            {
                ul_licence2.appendChild(li_element); 
                admin_part.classList.toggle("form_width"); 
                text_cycle.value ="";
                text_image.value="";
                text_lesson.value="";
                text_cycle.value="";
            }
            else if(text_cycle.value == "Licence 1" || text_cycle.value == "1" || text_cycle.value == "licence1")
            {
                ul_licence1.appendChild(li_element); 
                admin_part.classList.toggle("form_width"); 
                text_cycle.value ="";
                text_image.value="";
                text_lesson.value="";
                text_prof.value="";
            }
            else
            {
                alert("Le cycle est non connu !");
            }

        }
    else
        alert("Complétez-vous !!");
});


*/