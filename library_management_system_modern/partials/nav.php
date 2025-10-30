<?php
if(!isset($_SESSION['user'])) return;
$u = $_SESSION['user'];
?>
<header class="topbar">
  <div class="brand"><span style="width:36px;height:36px;display:inline-block;border-radius:8px;background:linear-gradient(90deg,#60a5fa,#2563eb);"></span><span>LibraryTrack</span></div>
  <div class="nav-actions">
    <a href="dashboard.php">Dashboard</a>
    <a href="users.php">Students</a>
    <a href="books.php">Books</a>
    <a href="transactions.php">Borrow/Return</a>
    <a class="btn" href="logout.php">Logout (<?=htmlspecialchars($u['name'])?>)</a>
  </div>
</header>
