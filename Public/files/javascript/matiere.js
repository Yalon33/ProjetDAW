const   btn_list_diapos_left=document.querySelector(".btn_list_diapos_left"),
        // btn_list_videos_left=document.querySelector(".btn_list_videos_left"),
        btn_list_diapos_right=document.querySelector(".btn_list_diapos_right"),
        // btn_list_videos_right=document.querySelector(".btn_list_videos_right"),
        list_diapos=document.querySelector(".list_item"),
        modal_pdf = document.querySelector("div.modal_pdf"),
        icon_close_modal = document.querySelector("i.icon_close");

list_diapos.addEventListener("click",(e)=>{
    modal_pdf.classList.toggle("hidden");
  
});

icon_close_modal.addEventListener("click",(e)=>
{
    modal_pdf.classList.toggle("hidden");
    console.log(e.target);
}
);

btn_list_diapos_left.addEventListener("click",() =>
{
    let scroll = document.querySelector("ul.list_diapos");
    scroll.scrollLeft +=500;
    console.log(scroll.scrollLeft);
});

// btn_list_videos_left.addEventListener("click",() =>
// {
//     let scroll = document.querySelector("ul.list_videos");
//     if (scroll.scrollLeft <= scroll.scrollWidth )
//     {
//         scroll.scrollLeft +=500;
//         console.log(scroll.scrollLeft);
//     }
// });

btn_list_diapos_right.addEventListener("click",() =>
{
    let scroll = document.querySelector("ul.list_diapos");
    scroll.scrollLeft -=500;
    console.log(scroll.scrollLeft);
});

// btn_list_videos_right.addEventListener("click",() =>
// {
//     let scroll = document.querySelector("ul.list_videos");
//     if (scroll.scrollLeft >= 0 )
//     {
//         scroll.scrollLeft -=500;
//         console.log(scroll.scrollLeft);
//     }
// });

const btn_add_lesson = document.querySelector("div.btn_add"),
        admin_part = document.querySelector(".admin_form"),
        btn_close = document.querySelector(".btn_close"),
        btn_add_item = document.querySelector(".btn_add_item"),
        ul_list_diapos = document.querySelector("#diapos");
        // ul_list_videos = document.querySelector("#videos");
      
function toggle_form()
    {
        admin_part.classList.toggle("form_width"); 
    }

btn_add_lesson.addEventListener("click",toggle_form);
btn_close.addEventListener("click",toggle_form); 

btn_add_item.addEventListener("click",(e)=>
{
    var text_url = document.querySelector("#image_form"),
        text_titre = document.querySelector("#titre_form");
        // checkbox_diapo = document.querySelector("#diapo");
    //     // checkbox_video = document.querySelector("#video");
    // if(text_titre.value.length != 0 && text_titre.value.length !=0 && (checkbox_diapo.checked || checkbox_video.checked))
    // {
        li_element = document.createElement("li");

        div_item_element = document.createElement("div");
        div_item_element.classList = "list_diapos_item list_item";
        image_element = document.createElement("img");
        image_element.src = "../image/image_login_1.png";
        image_element.style.height ="100%";
        image_element.style.width ="100%";
        image_element.style.borderRadius ="5px";
        div_item_element.appendChild(image_element);


        p_titre_element = document.createElement("p");
        p_titre_element.className = "titre_item";
        p_titre_element.innerText = text_titre.value.toString();

        div_modal_element = document.createElement("div");
        div_modal_element.className = "modal_pdf hidden";
        icon_modal = document.createElement("i");
        icon_modal.className = "bx bx-x icon_close";
        div_pdf_modal = document.createElement("div");
        div_pdf_modal.className="pdf";
        iframe_pdf_modal = document.createElement("iframe");
        iframe_pdf_modal.src = text_url.value.toString();
        iframe_pdf_modal.style.height="100%";
        iframe_pdf_modal.style.width="100%";
        div_pdf_modal.appendChild(iframe_pdf_modal);
        div_modal_element.appendChild(icon_modal);
        div_modal_element.appendChild(div_pdf_modal);

        li_element.appendChild(div_item_element);
        li_element.appendChild(p_titre_element);
        li_element.appendChild(div_modal_element);

        // if(checkbox_diapo.checked)
        // {
            ul_list_diapos.appendChild(li_element);
        // }
        // else
        // {
        //     ul_list_videos.appendChild(li_element);
        // }
        text_titre.value="";
        text_url.value="";
        // checkbox_diapo.checked=false;
        // checkbox_video.checked=false;
        toggle_form();


    // }
    // else
    // {
    //     alert("Complétez-vous !!");
    // }
    // console.log(e.target);

});