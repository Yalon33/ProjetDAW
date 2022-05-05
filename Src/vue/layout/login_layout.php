<!DOCTYPE html>
<html lang="en">
<head>
<title>ProjetDAW</title>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<?php if (Application::getInstance()->request()->getPath() === '/login'): ?>
    <link rel="stylesheet" href="files/css/login.css" media="all" type="text/css">
<?php elseif (Application::getInstance()->request()->getPath() === '/register'): ?>
    <link rel="stylesheet" href="files/css/register.css" media="all" type="text/css">
<?php endif ?>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
</head>
<body class="dark">
    {{content}}
</body>
</html>
     