<?php
require 'config.php';
// If already logged in, go to dashboard
if(isset($_SESSION['user'])) {
    header('Location: dashboard.php'); exit;
}
$error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if($user && password_verify($password, $user['password'])) {
        unset($user['password']);
        $_SESSION['user'] = $user;
        header('Location: dashboard.php'); exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Library System - Login</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="center">
  <div class="card">
    <h2>Library Management Login</h2>
    <?php if($error): ?><div class="error"><?=htmlspecialchars($error)?></div><?php endif; ?>
    <form method="post" action="">
      <label>Email<input type="email" name="email" required></label>
      <label>Password<input type="password" name="password" required></label>
      <button type="submit">Login</button>
    </form>
    <p style="font-size:.9em;color:#666">Default admin: admin@gmail.com / admin@123</p>
  </div>
</body>
</html>
