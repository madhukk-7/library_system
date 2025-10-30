<?php
require 'config.php';
if(!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM books WHERE id=?');
$stmt->execute([$id]); $book = $stmt->fetch();
if(!$book) { header('Location: books.php'); exit; }
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $title = $_POST['title']; $author = $_POST['author']; $isbn = $_POST['isbn']; $qty = max(1,intval($_POST['qty']));
  // adjust available_qty relative to total change
  $diff = $qty - $book['total_qty'];
  $available = $book['available_qty'] + $diff;
  if($available < 0) $available = 0;
  $stmt = $pdo->prepare('UPDATE books SET title=?,author=?,isbn=?,total_qty=?,available_qty=? WHERE id=?');
  $stmt->execute([$title,$author,$isbn,$qty,$available,$id]);
  header('Location: books.php'); exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Edit Book</title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<?php include 'partials/nav.php'; ?><main class="container"><h2>Edit Book</h2>
<form method="post">
  <label>Title<input name="title" value="<?=htmlspecialchars($book['title'])?>" required></label>
  <label>Author<input name="author" value="<?=htmlspecialchars($book['author'])?>"></label>
  <label>ISBN<input name="isbn" value="<?=htmlspecialchars($book['isbn'])?>"></label>
  <label>Quantity<input type="number" name="qty" value="<?= $book['total_qty'] ?>" min="1"></label>
  <button type="submit">Update</button>
</form></main></body></html>
