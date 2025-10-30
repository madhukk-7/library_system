<?php
require 'config.php';
if(!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
$users = $pdo->query('SELECT id,name,email,role,created_at FROM users ORDER BY id DESC')->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Users</title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<?php include 'partials/nav.php'; ?><main class="container"><h2>Users</h2>
<a class="btn" href="add_user.php">+ Add User</a>
<table class="table"><thead><tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Added</th></tr></thead><tbody>
<?php foreach($users as $u): ?>
  <tr><td><?=$u['id']?></td><td><?=htmlspecialchars($u['name'])?></td><td><?=htmlspecialchars($u['email'])?></td><td><?=$u['role']?></td><td><?=$u['created_at']?></td></tr>
<?php endforeach; ?>
</tbody></table></main></body></html>
