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

