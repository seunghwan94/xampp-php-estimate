<?php
if(!isset($_GET['Theme'])) $_GET['Theme'] = 'estimate_print_list';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="lib/js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- 별도의 CSS 파일을 연결
        <link rel="stylesheet" href="styles.css"> -->
    <title>아빠 견적서</title>
</head>
<body>
    <div>
        <?include "lib/constents.php"?>
        <?include "lib/function.php"?>
        <?include "lib/header.php"?>
    </div>
    <div style='margin: 30px;'>
        <?include $_GET['Theme'].".php"?>
    </div>
</body>
</html>