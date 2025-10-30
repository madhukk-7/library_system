<?php
require 'config.php';
if(!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name=$_POST['name']; $email=$_POST['email']; $pass=$_POST['password']; $role=$_POST['role'];
  $hash = password_hash($pass, PASSWORD_BCRYPT);
  $stmt = $pdo->prepare('INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)');
  $stmt->execute([$name,$email,$hash,$role]);
  header('Location: users.php'); exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Add User</title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<?php include 'partials/nav.php'; ?><main class="container"><h2>Add User</h2>
<form method="post">
  <label>Name<input name="name" required></label>
  <label>Email<input type="email" name="email" required></label>
  <label>Password<input type="password" name="password" required></label>
  <label>Role<select name="role"><option value="librarian">Librarian</option><option value="member">Member</option></select></label>
  <button type="submit">Create</button>
</form></main></body></html>
