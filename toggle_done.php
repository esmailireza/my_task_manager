<?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['id'])) {
    $stmt = $pdo->prepare("SELECT is_done FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
    $task = $stmt->fetch();

}
if ($task) {
    $newStatus = $task['is_done'] ? 0 : 1;
    $stmt = $pdo -> prepare("UPDATE tasks SET is_done = :is_done WHERE id = :id");
    $stmt -> execute(['id' => $_POST['id'] , 'is_done' => $newStatus ]);
    
    header('Location: index.php');
    exit;
}

?>