<?php
require 'config.php';
if(!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
$id = intval($_GET['id'] ?? 0);
if($id){
  $pdo->prepare('DELETE FROM books WHERE id=?')->execute([$id]);
}
header('Location: books.php'); exit;
