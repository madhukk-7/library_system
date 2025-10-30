<?php
require 'config.php';
if(!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
$rows = $pdo->query('SELECT t.*, u.name as uname, b.title as btitle FROM transactions t JOIN users u ON u.id=t.user_id JOIN books b ON b.id=t.book_id ORDER BY t.id DESC')->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Transactions</title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<?php include 'partials/nav.php'; ?><main class="container"><h2>Transactions</h2>
<table class="table"><thead><tr><th>#</th><th>User</th><th>Book</th><th>Type</th><th>Status</th><th>Due</th></tr></thead><tbody>
<?php foreach($rows as $r): ?>
  <tr>
    <td><?=$r['id']?></td>
    <td><?=htmlspecialchars($r['uname'])?></td>
    <td><?=htmlspecialchars($r['btitle'])?></td>
    <td><?=$r['type']?></td>
    <td><?=$r['status']?></td>
    <td><?=$r['due_date']?></td>
  </tr>
<?php endforeach; ?>
</tbody></table></main></body></html>
