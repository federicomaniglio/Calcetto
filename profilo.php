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

$pdo = Database::getInstance()->getConnection();
$stmt = $pdo->prepare("SELECT * FROM prenotazioni WHERE id_utente = :id");
$stmt->execute(["id" => $_SESSION['user_id']]);
$prenotazioni = $stmt->fetchAll();

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
<?php include 'navigation.php'; ?>
<h1><?= $title ?></h1>


<div class="profilo">
    <p>Benvenuto, <?= $_SESSION['username'] ?>!</p>

    <?php if (isset($prenotazioni)): ?>
        <h4>Prenotazioni effettuate:</h4>
        <ul>
            <?php foreach ($prenotazioni as $prenotazione): ?>

                <li class="singola-prenotazione">
                    <a href="campi.php?id_campo=<?= $prenotazione['id_campo'] ?>">
                        <?= $prenotazione['id_campo'] . " - " . $prenotazione['data_prenotazione'] ?>
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <h4>Non hai ancora effettuato prenotazioni.</h4>
    <?php endif; ?>


    <form method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>


</body>
</html>
