<?php
require_once 'database.php';
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$title = "Profilo";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
</head>
<body>
<?php include 'navigation.php'; ?>
<h1><?= $title ?></h1>
<form method="post">
    <button type="submit" name="logout">Logout</button>
</form>

<?php


var_dump($_SESSION);
?>
</body>
</html>
