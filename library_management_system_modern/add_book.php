<?php
require 'config.php';
if(!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
$error=''; if($_SERVER['REQUEST_METHOD']==='POST'){
  $title = $_POST['title']; $author = $_POST['author']; $isbn = $_POST['isbn']; $qty = max(1,intval($_POST['qty']));
  $stmt = $pdo->prepare('INSERT INTO books (title,author,isbn,total_qty,available_qty) VALUES (?,?,?,?,?)');
  $stmt->execute([$title,$author,$isbn,$qty,$qty]);
  header('Location: books.php'); exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Add Book</title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<?php include 'partials/nav.php'; ?>
<main class="container"><h2>Add Book</h2>
<form method="post">
  <label>Title<input name="title" required></label>
  <label>Author<input name="author"></label>
  <label>ISBN<input name="isbn"></label>
  <label>Quantity<input type="number" name="qty" value="1" min="1"></label>
  <button type="submit">Save</button>
</form></main></body></html>
