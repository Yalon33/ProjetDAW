<!DOCTYPE html>
<html lang="en">
<head>
<title>ProjetDAW</title>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="../files/css/menu.css">
<link rel="stylesheet" href="../files/css/banderole.css">

<?php if (Application::getInstance()->request()->getPath() === '/user'): ?>
    <link rel="stylesheet" href="../files/css/userpage.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/home'): ?>
    <link rel="stylesheet" href="../files/css/home.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/addMatiere'): ?>
    <link rel="stylesheet" href="../files/css/userpage.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/addDocument/{id}'): ?>
    <link rel="stylesheet" href="../files/css/userpage.css">
    <?php elseif (Application::getInstance()->request()->getPath() === '/addCanal/{id}'): ?>
    <link rel="stylesheet" href="../files/css/userpage.css">
    <?php elseif (Application::getInstance()->request()->getPath() === '/addForum'): ?>
    <link rel="stylesheet" href="../files/css/userpage.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/forum'): ?>
    <link rel="stylesheet" href="../files/css/forum.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/canal/{id}'): ?>
    <link rel="stylesheet" href="../files/css/canal.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/matieres'): ?>
    <link rel="stylesheet" href="../files/css/home.css">
<?php elseif (Application::getInstance()->request()->getPath() === '/matieres/{id}'): ?>
    <link rel="stylesheet" href="../files/css/home.css">
    <link rel="stylesheet" href="../files/css/matiere.css">
    <style>
        <?php include(Application::getInstance()->currDir()."/Public/files/css/matiere.css") ?>
    </style>
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
    <?php if (Application::getInstance()->request()->getPath() === '/matieres/{id}'): ?>
        <script src="../files/javascript/matiere.js"></script>
    <?php endif ?>
</body>
</html>

     