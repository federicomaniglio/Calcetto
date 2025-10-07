<?php
session_start();

require_once 'database.php';
$title = "Login";
$errore = "";

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if (!empty($_POST)) {
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM utenti WHERE username = :username");
    $stmt->execute(["username" => $_POST["username"]]);
    $utente = $stmt->fetch();
    
    if ($utente && password_verify($_POST["password"], $utente["password"])) {
        $_SESSION['user_id'] = $utente['id'];
        $_SESSION['username'] = $utente['username'];
        header("Location: profilo.php");
        exit;
    } else {
        $errore = "Username o password errati";
    }
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navigation.php'; ?>
<div class="container">

    <form method="post" class="login-form">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <?php if ($errore): ?>
            <div class="error"><?= htmlspecialchars($errore) ?></div>
        <?php endif; ?>
    </form>

</div>
</body>
</html>
