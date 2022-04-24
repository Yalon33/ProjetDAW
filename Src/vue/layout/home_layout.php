<!DOCTYPE html>
<html lang="en">
<head>
<title>ProjetDAW</title>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="files/css/menu.css">
<link rel="stylesheet" href="files/css/banderole_menu.css">

<?php if (Application::getInstance()->request()->getPath() === '/user'): ?>
    <link rel="stylesheet" href="files/css/userpage.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/home'): ?>
    <link rel="stylesheet" href="files/css/homepage.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/lesson_suivi'): ?>
    <link rel="stylesheet" href="files/css/homepage.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/lessons'): ?>
    <link rel="stylesheet" href="files/css/lessonpage.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/forums'): ?>
    <link rel="stylesheet" href="files/css/forum.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/message'): ?>
    <link rel="stylesheet" href="files/css/message1.css">
<?php endif ?>

<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
</head>

<body class="dark">
    <nav class="menu_sidebar">
        <?php 
            include('Src/vue/html/menu.php');
        ?>
    </nav>
    <div class="page_contenu">
        <?php include('Src/vue/html/banderole.php'); ?> 
        {{content}}
    </div>
</body>
</html>

<!-- 
  -->

     