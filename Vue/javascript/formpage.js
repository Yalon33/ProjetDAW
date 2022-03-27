const btn_send = document.querySelector('.btn_send'),
        message = document.querySelector('#message'),
        window_talk = document.querySelector('ul.window_talk_inner');
function send_message()
{
    if(message.value.length!=0)
    {
        /*
        var width="";
        var widthMessage =message.value.length*11.5;
        if(widthMessage >= (window_talk.scrollWidth * 70)/100)
            width="70%";
            
        else
            width = widthMessage.toString()+"px";
        */
        console.log(message.value);
        // Crée la balise li de liste ul
        li_message= document.createElement('li');
        // Crée la balise div.message qui contient message_text et mesage_image
        div_message= document.createElement('div');
        div_message.className="message";
        // Crée la balise div.message_inner
        p_message_text= document.createElement('p');
        p_message_text.className = "message_text";
        p_message_text.innerText = message.value;
        /*p_message_text.style.width = width;*/
        // Crée la balise div.mesage_image
        div_message_image= document.createElement('div');
        div_message_image.className= "message_image";
        img = document.createElement('img');
        img.src = "../image/cuteduck.jpg";
        div_message_image.appendChild(img);
        // Ajoute dans les balises principaux
        div_message.appendChild(div_message_image);
        div_message.appendChild(p_message_text);

        li_message.appendChild(div_message);

        window_talk.appendChild(li_message);
        message.value="";
        window_talk.scrollTop = window_talk.scrollHeight;
    }
    else
        console.log("VIDE");
}

btn_send.addEventListener("click",send_message);

message.addEventListener("keyup", function(event) {
   if (event.keyCode === 13) {
    event.preventDefault();
    btn_send.click();
   }
});