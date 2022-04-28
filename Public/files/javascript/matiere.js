const btn_list_diapos_left=document.querySelector(".btn_list_diapos_left"),
      btn_list_diapos_right=document.querySelector(".btn_list_diapos_right"),
      list_diapos=document.querySelector(".list_item"),
      modal_pdf = document.querySelector("div.modal_pdf"),
      ul_list_diapos = document.querySelector("#diapos");

list_diapos.addEventListener("click",(e)=>
{
    modal_pdf.classList.toggle("hidden");
});

btn_list_diapos_left.addEventListener("click",() =>
{
    let scroll = document.querySelector("ul.list_diapos");
    scroll.scrollLeft +=500;
    console.log(scroll.scrollLeft);
});

btn_list_diapos_right.addEventListener("click",() =>
{
    let scroll = document.querySelector("ul.list_diapos");
    scroll.scrollLeft -=500;
    console.log(scroll.scrollLeft);
});