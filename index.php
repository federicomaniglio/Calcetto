<?php
require_once 'database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$title = "Calcetto"
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navigation.php' ?>
<h1><?= $title ?></h1>

<?php
$pdo = Database::getInstance()->getConnection();

$result = $pdo->query("SELECT * FROM campi ORDER BY capienza DESC");
foreach ($result as $row) {
    ?>
    <hr>
    <div class="campo">
        <h3><?= htmlspecialchars($row['nome_campo']) ?></h3>
        <div class="box-immagine">
            <a href="campi.php?id_campo=<?= urlencode($row['nome_campo']) ?>">
                <img src="<?= htmlspecialchars($row['foto_url']) ?>" 
                     alt="<?= htmlspecialchars($row['nome_campo']) ?>">
            </a>
        </div>
        <p><?= htmlspecialchars($row['capienza']) ?> persone</p>
    </div>
    <?php
}

?>
<div>


</div>


</body>
</html>




