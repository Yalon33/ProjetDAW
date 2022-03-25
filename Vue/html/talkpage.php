<!DOCTYPE html>
<html lang="en">
<head>
<title>Home Page</title>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="../css/talkpage.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true"> 
</head>
<body class="dark">
        <?php include('./menu.html');?>
        <div class="page_contenu">
            <?php include("banderole.html");?>
            <div class="talkpage_inner">
                <p class="titre_lesson">Form <span class="nom_prof">discusion</span> </p>
                <div class="window_talk">
                    <ul class=window_talk_inner>
                    </ul>
                    <div class="enter_message">
                        <div class="enter_message_inner">
                            <div widow_talk_icon>
                                <i class='bx bx-link' ></i>
                                <i class='bx bx-photo-album' ></i>
                            </div>
                            <input type="text" name="message" id="message" placeholder="Aa">
                            <button class="btn_send"><i class='bx bx-send' ></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="../javascript/talkpage.js"></script>
</body>
</html>
            