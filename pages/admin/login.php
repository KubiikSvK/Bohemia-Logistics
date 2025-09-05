<?php
require_once '../../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Přesměrování pokud už je přihlášen
if (isAdminLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF ochrana
    if (!validateCSRFToken($_POST['csrf_token'] ?? '')) {
        $error = "Neplatný bezpečnostní token.";
    } else {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = $_POST['password'] ?? '';
        
        $users = loadAdminUsers();
        if ($users === false) {
            $error = "Chyba při načítání uživatelů.";
        } else {
            foreach ($users as $user) {
                if ($user['username'] === $username && password_verify($password, $user['password'])) {
                    $_SESSION['admin'] = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
                    $_SESSION['login_time'] = time();
                    header('Location: dashboard.php');
                    exit;
                }
            }
            $error = "Neplatné přihlašovací údaje.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title>Admin přihlášení</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="login-container">
  <h2><i class="fas fa-lock"></i> Admin přihlášení</h2>

  <?php if ($error): ?>
    <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
  <?php endif; ?>

  <form method="post">
    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
    <input type="text" name="username" placeholder="Uživatelské jméno" required maxlength="50">
    <input type="password" name="password" placeholder="Heslo" required maxlength="100">
    <button type="submit"><i class="fas fa-sign-in-alt"></i> Přihlásit se</button>
  </form>
</div>

<?php include 'admin-footer.php'; ?>
</body>
</html>