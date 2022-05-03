const icon_menu= document.querySelector(".icon_toggle");
const toggle_switch= document.querySelector(".toggle-switch");

//Méthode pour agrandir/rétrécir le menu_bar
icon_menu.addEventListener("click",() =>
{
    const nav= document.querySelector("nav");
    if(nav.classList.contains('menu_sidebar')){

        nav.classList.remove('menu_sidebar');
        nav.classList.add('menu_sidebar_complete');
    }else{

        nav.classList.remove('menu_sidebar_complete');
        nav.classList.add('menu_sidebar');
    }
});

//Méthode pour changer de thème (sombre/clair)
toggle_switch.addEventListener("click",() =>
{
    const body = document.body;
    const labelMode = document.querySelector(".vision_mode");

    if(body.classList.contains('light')){

        body.classList.remove('light');
        body.classList.add('dark');
        labelMode.innerHTML = "Dark Mode";
    }else{
        body.classList.remove('dark');
        body.classList.add('light');
        labelMode.innerHTML = "Light Mode";
    }
});