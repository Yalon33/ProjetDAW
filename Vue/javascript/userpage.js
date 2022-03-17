const icon_menu= document.querySelector(".icon_toggle"),
        nav= document.querySelector("nav"),
        body=document.querySelector("body"),
        toggle_switch=document.querySelector(".toggle-switch"),
        icon_hover = document.querySelector(".icon_hover"),
        li_menu_user = document.querySelector("li.menu_user");
icon_menu.addEventListener("click",(e) =>
{
    console.log(e.target);
    nav.classList.toggle("menu_sidebar");
});
toggle_switch.addEventListener("click",() =>
{
    body.classList.toggle("dark");
});

