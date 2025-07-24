<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['title']) && isset($_POST['id'])) {
    $stmt = $pdo->prepare("UPDATE tasks SET title = :title WHERE id = :id");
    $stmt->execute([
        'id' => $_POST['id'],
        'title' => $_POST['title']
    ]);
    header('Location: index.php');
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
    $task = $stmt->fetch();

    echo '<form method="POST" action="edit_task.php">
            <input type="hidden" name="id" value="' . htmlspecialchars($task['id']) . '">
            <input type="text" name="title" value="' . htmlspecialchars($task['title']) . '">
            <button type="submit" name="edit-task">ویرایش</button>
          </form>';
} else {
    echo "درخواست نامعتبر است.";
}
