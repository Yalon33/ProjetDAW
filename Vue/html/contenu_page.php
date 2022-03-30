<?php 
if (isset($_GET['page']))
{
        $link = $_GET['page'].".php";
        include("$link");
}
else
        include("homepage.php");

?>