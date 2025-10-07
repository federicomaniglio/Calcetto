<?php
require_once 'database.php';
session_start();
$errorePrenotazione = false;

if (!empty($_POST)) {
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("INSERT INTO prenotazioni (id_utente, id_campo,  data_prenotazione) VALUES ( :id_utente, :id_campo, :data_prenotazione) ");
    try {
        $stmt->execute(["id_utente" => $_POST["id_utente"], "id_campo" => $_POST["id_campo"], "data_prenotazione" => $_POST["data_prenotazione"]]);
    } catch (Exception $e) {
        $errorePrenotazione = true;
    }
}


$title = $_GET['id_campo'];
$pdo = Database::getInstance()->getConnection();
$stmt = $pdo->prepare("SELECT * FROM campi WHERE nome_campo = :nome_campo");
$stmt->execute(["nome_campo" => $_GET['id_campo']]);
$campo = $stmt->fetch();

if (!$campo) {
    header("Location: index.php");
    exit;
}

$stmt->closeCursor();
$stmt = $pdo->prepare("SELECT prenotazioni.*, utenti.username FROM prenotazioni 
                       INNER JOIN utenti ON prenotazioni.id_utente = utenti.id 
                       WHERE prenotazioni.id_campo = :id_campo");
$stmt->execute(["id_campo" => $_GET['id_campo']]);
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
<div class="campo">
    <h1><?= $title ?></h1>
    <div class="box-immagine">
        <img src="<?= $campo['foto_url'] ?>" alt="<?= $title ?>">
    </div>
    <p>Capienza <?= $campo['capienza'] ?> persone</p>
    <?php
    if (count($prenotazioni) > 0) { ?>
        <div class="prenotazioni">
            <h3>Prenotazioni</h3>
            <?php foreach ($prenotazioni as $prenotazione) { ?>
                <p> <?= $prenotazione['username'] . " - " . date('d M Y', strtotime($prenotazione['data_prenotazione'])); ?> </p>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="form-prenotazione">
        <h3>Prenota</h3>
        <form method="post">
            <input type="hidden" name="id_campo" value="<?= $_GET['id_campo'] ?>">
            <label>
                <select name="id_utente" required>
                    <?php
                    $stmt = $pdo->query("SELECT id, username FROM utenti");
                    while ($utente = $stmt->fetch()) {
                        echo "<option value='" . $utente['id'] . "'>" . $utente['username'] . "</option>";
                    }
                    ?>
                </select>
            </label>
            <label>
                <input type="date" name="data_prenotazione" required>
            </label>
            <input type="submit" value="Prenota">
        </form>
        <?php if ($errorePrenotazione)
            echo "<p class = 'error'>Campo non disponibile per quel giorno</p>";
        ?>
    </div>
</div>
</body>
</html>
