<?php 
error_reporting(E_ALL);
ini_set('display_error',1);
include 'db.php';
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['title'])) {
  echo $_POST['title'];
    $title = trim($_POST['title']);
    $stmt = $pdo -> prepare("INSERT INTO tasks (title) VALUES (:title)");
    $stmt -> execute(['title' => $title ]);
}
header("Location: index.php");
exit;
?>