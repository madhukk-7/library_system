<?php
require 'config.php';
if(!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
$q = trim($_GET['q'] ?? '');
$results = [];
if($q !== '') {
  $stmt = $pdo->prepare("SELECT * FROM books WHERE title LIKE ? OR author LIKE ? OR isbn LIKE ?");
  $like = '%'.$q.'%';
  $stmt->execute([$like,$like,$like]);
  $results = $stmt->fetchAll();
}
?>
<!doctype html><html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width,initial-scale=1'><title>Search</title><link rel='stylesheet' href='assets/css/style.css'></head><body>
<?php include 'partials/nav.php'; ?><main class='container'><h2>Search Books</h2>
<form method="get"><input name="q" placeholder="title, author or isbn" value="<?=htmlspecialchars($q)?>"><button type="submit">Search</button></form>
<?php if($q !== ''): ?>
  <h3>Results (<?=count($results)?>)</h3>
  <ul>
    <?php foreach($results as $r): ?>
      <li><?=htmlspecialchars($r['title'])?> — <?=htmlspecialchars($r['author'])?> (Available: <?=$r['available_qty']?>)</li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>
</main></body></html>
