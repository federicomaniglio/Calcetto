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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        
        .login-header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 30px;
            border-radius: 20px 20px 0 0;
            text-align: center;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: bold;
            transition: transform 0.2s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 38px;
            cursor: pointer;
            color: #667eea;
            font-size: 1.2rem;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
    </style>
</head>
<body>
<?php include 'navigation.php'; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card login-card border-0">
                <div class="login-header">
                    <i class="bi bi-person-circle" style="font-size: 3rem;"></i>
                    <h2 class="mt-2 mb-0">Accedi</h2>
                </div>
                <div class="card-body p-4">
                    <?php if ($errore): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?= htmlspecialchars($errore) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">
                                <i class="bi bi-person-fill text-primary me-1"></i>Username:
                            </label>
                            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Inserisci il tuo username" required>
                        </div>
                        <div class="mb-4 position-relative">
                            <label for="password" class="form-label fw-bold">
                                <i class="bi bi-lock-fill text-primary me-1"></i>Password:
                            </label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Inserisci la tua password" required>
                            <i class="bi bi-eye-fill password-toggle" id="togglePassword" onclick="togglePasswordVisibility()"></i>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Accedi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePasswordVisibility() {
    var passwordField = document.getElementById('password');
    var toggleIcon = document.getElementById('togglePassword');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('bi-eye-fill');
        toggleIcon.classList.add('bi-eye-slash-fill');
    } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash-fill');
        toggleIcon.classList.add('bi-eye-fill');
    }
}
</script>
</body>
</html>
