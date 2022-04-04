
<!DOCTYPE html>
<html lang="en">
<head>
<title>Home Page</title>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="../css/homepage.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta charset="UTF-8">
</head>
<body class="dark">
    <nav class="menu_sidebar">
        <?php include('./menu.php');?>
    </nav>
    <div class="page_contenu">
        <?php 
            include('banderole.php'); 
            include('./contenu_page.php');
        ?>
    </div>
</body>
</html>
     