<?php
checkUser(false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo empty($page_title) ? 'FORM PHP' : $page_title?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.min.css">
</head>
<body>
    <h1><?php echo 'Xin chào, '. $_SESSION['user']?></h1>
    <a href="index.php?action=logout">Đăng xuất</a>
</body>
</html>