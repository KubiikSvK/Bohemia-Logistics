logi<?php
session_start();

$users = json_decode(file_get_contents(__DIR__ . '/includes/admin-users.json'), true);
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"] ?? "";
  $password = $_POST["password"] ?? "";

  foreach ($users as $user) {
    if ($user["username"] === $username && password_verify($password, $user["password"])) {
      session_start();
        $_SESSION["admin"] = $username;
      header("Location: dashboard.php");
      exit;
    }
  }

  $error = "Neplatné přihlašovací údaje.";
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
    <p class="error"><?php echo $error; ?></p>
  <?php endif; ?>

  <form method="post">
    <input type="text" name="username" placeholder="Uživatelské jméno" required>
    <input type="password" name="password" placeholder="Heslo" required>
    <button type="submit"><i class="fas fa-sign-in-alt"></i> Přihlásit se</button>
  </form>
</div>

<?php include 'admin-footer.php'; ?>
</body>
</html>