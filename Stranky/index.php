<?php
ob_start();
session_start();
include "config.php";

function __autoload($className)
{
    if (file_exists('./class/' . $className . '.php')) {
        require_once './class/' . $className . '.php';
        return true;
    }
    return false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="layout.css">
    <title>FBC Letohrad</title>
</head>
<body>
<header>
    <?php
    include './page/header.php';
    ?>
</header>

<?php
    if (isset($_GET['page']))
    {
        $file = "./page/" . $_GET["page"] . ".php";
        if (file_exists($file)) {
            include $file;
        }
    }else {
        include "./page/uvod.php";
    }
?>



<footer>
    <?php
    include './page/footer.php';
    ?>
</footer>
</body>
</html>