<?php
require 'config.php';
if(!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
// simple list
$q = $pdo->query('SELECT * FROM books ORDER BY id DESC')->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Books</title><link rel="stylesheet" href="assets/css/style.css">
</head><body>
<?php include 'partials/nav.php'; ?>
<main class="container">
  <h2>Books <a class="btn" href="add_book.php">+ Add</a></h2>
  <table class="table"><thead><tr><th>#</th><th>Title</th><th>Author</th><th>ISBN</th><th>Available</th><th>Actions</th></tr></thead><tbody>
  <?php foreach($q as $b): ?>
    <tr>
      <td><?= $b['id'] ?></td>
      <td><?= htmlspecialchars($b['title']) ?></td>
      <td><?= htmlspecialchars($b['author']) ?></td>
      <td><?= htmlspecialchars($b['isbn']) ?></td>
      <td><?= $b['available_qty'] ?>/<?= $b['total_qty'] ?></td>
      <td>
        <a href="edit_book.php?id=<?=$b['id']?>">Edit</a> |
        <a href="delete_book.php?id=<?=$b['id']?>" onclick="return confirm('Delete?')">Delete</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody></table>
</main>
</body></html>
