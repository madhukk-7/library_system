<?php
require 'config.php';
if(!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
$user = $_SESSION['user'];
$booksCount = $pdo->query('SELECT COUNT(*) FROM books')->fetchColumn();
$usersCount = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$borrowed = $pdo->query("SELECT COUNT(*) FROM transactions WHERE type='borrow' AND status='approved'")->fetchColumn();
$available = $pdo->query('SELECT SUM(available_qty) FROM books')->fetchColumn();
$util = $booksCount ? round(($borrowed / $booksCount) * 100, 1) : 0;
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Library Dashboard</title>
<link rel="stylesheet" href="assets/css/style.css">
</head><body>
<?php include 'partials/nav.php'; ?>
<main class="container">
  <h1 style="margin:6px 0 0 0">Library Dashboard</h1>
  <p style="color:var(--muted);margin-top:4px">Welcome back! Here's an overview of your library system.</p>
  <div class="dashboard-grid">
    <div class="stat-card">
      <div class="label">Total Students</div>
      <div class="value"><?= intval($usersCount) ?></div>
      <div class="icon-pill pill-blue">S</div>
    </div>
    <div class="stat-card">
      <div class="label">Total Books</div>
      <div class="value"><?= intval($booksCount) ?></div>
      <div class="icon-pill pill-purple">B</div>
    </div>
    <div class="stat-card">
      <div class="label">Borrowed Books</div>
      <div class="value"><?= intval($borrowed) ?></div>
      <div class="icon-pill pill-yellow">⤴</div>
    </div>
    <div class="stat-card">
      <div class="label">Available Books</div>
      <div class="value"><?= intval($available) ?></div>
      <div class="icon-pill pill-green">✓</div>
    </div>
  </div>

  <div class="main-grid">
    <div class="card">
      <h3 style="margin-top:0">Quick Actions</h3>
      <div class="quick-actions">
        <a class="action" href="users.php"><div style="font-size:20px">👥</div><div><h4>Manage Students</h4><div style="color:var(--muted)">Add, edit, or view student records</div></div></a>
        <a class="action" href="books.php"><div style="font-size:20px">📚</div><div><h4>Manage Books</h4><div style="color:var(--muted)">Add, edit, or view book catalog</div></div></a>
        <a class="action" href="transactions.php"><div style="font-size:20px">🔁</div><div><h4>Borrow/Return Books</h4><div style="color:var(--muted)">Process book transactions</div></div></a>
      </div>
    </div>
    <div class="card">
      <h3 style="margin-top:0">System Information</h3>
      <ul class="system-info" style="list-style:none;padding:0;margin:12px 0 0 0">
        <li><span>Library Utilization</span><strong><?= $util ?>%</strong></li>
        <li><span>Active Borrowers</span><strong><?= intval($borrowed) ?></strong></li>
        <li><span>Books Available</span><strong><?= intval($available) ?></strong></li>
      </ul>
    </div>
  </div>
</main>
</body></html>
