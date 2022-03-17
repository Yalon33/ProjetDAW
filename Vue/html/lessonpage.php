<!DOCTYPE html>
<html lang="en">
<head>
<title>Lesson Page</title>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="../css/lessonpage.css">
<link rel="stylesheet" href="../css/menu.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true"> 
</head>
<body class="dark">
        
        <?php include("./menu.html");?>

        <div class="page_contenu">
            
            <?php include("./banderole.html");?>

            <div class="lesson_inner">
                <p class="titre_lesson">Titre de cours <span class="nom_prof">Nom de prof</span> </p>
                <div class="list_diapos">
                    <div class="list_diapos_inner">
                        <p class="titre_list_diapos">Diapos de cours:</p>
                        <ul class="list_diapos" id="diapos">
                            <li>
                                <div class="list_diapos_item">
                                    Diapo 1
                                </div>
                                <p class="titre_item">titre de diapo 1 </p>
                            </li>
                            <li>
                                <div class="list_diapos_item">
                                    Diapo 2
                                </div>
                                <p class="titre_item">titre de diapo 2 </p>
                            </li>
                            <li>
                                <div class="list_diapos_item">
                                    Diapo 3
                                </div>
                                <p class="titre_item">titre de diapo 3 </p>
                            </li>
                            <li>
                                <div class="list_diapos_item">
                                    Diapo 4
                                </div>
                                <p class="titre_item">titre de diapo 4 </p>
                            </li>
                            <li>
                                <div class="list_diapos_item">
                                    Diapo 5
                                </div>
                                <p class="titre_item">titre de diapo 5 </p>
                            </li>
                            <li>
                                <div class="list_diapos_item">
                                    Diapo 6
                                </div>
                                <p class="titre_item">titre de diapo 6 </p>
                            </li>
                            <li>
                                <div class="list_diapos_item">
                                    Diapo 7
                                </div>
                                <p class="titre_item">titre de diapo 7 </p>
                            </li>
                        </ul>
                    </div>
                    <button class="btn_list_diapos_right"><i class='bx bxs-left-arrow' ></i></button>
                    <button class="btn_list_diapos_left"><i class='bx bxs-right-arrow' ></i></button>

                </div>
                <div class="list_videos">
                    <div class="list_videos_inner">
                        <p class="titre_list_videos">Videos de cours:</p>
                        <ul class="list_videos" id="videos">
                            <li>
                                <div class="list_videos_item">
                                    Video 1
                                </div>
                                <p class="titre_item">titre de diapo 1 </p>
                            </li>
                            <li>
                                <div class="list_videos_item">
                                    Video 2
                                </div>
                                <p class="titre_item">titre de diapo 1 </p>
                            </li>
                            <li>
                                <div class="list_videos_item">
                                    Video 3
                                </div>
                                <p class="titre_item">titre de diapo 1 </p>
                            </li>
                            <li>
                                <div class="list_videos_item">
                                    Video 4
                                </div>
                                <p class="titre_item">titre de diapo 1 </p>
                            </li>
                            <li>
                                <div class="list_videos_item">
                                    Video 5
                                </div>
                                <p class="titre_item">titre de diapo 1 </p>
                            </li>
                            <li>
                                <div class="list_videos_item">
                                    Video 6
                                </div>
                                <p class="titre_item">titre de diapo 1 </p>
                            </li>
                            <li>
                                <div class="list_videos_item">
                                    Video 7
                                </div>
                                <p class="titre_item">titre de diapo 1 </p>
                            </li>
                        </ul>
                    </div>
                    <button class="btn_list_videos_right"><i class='bx bxs-left-arrow' ></i></button>
                    <button class="btn_list_videos_left"><i class='bx bxs-right-arrow'></i></button>
                </div>
                <div class="lessonpage_dark"></div>
            </div>
            <div class="footer"></div>
        </div>
       
</body>
<script src="../javascript/lessonpage.js"></script>
</html>