<?php
include 'db.php';
echo "edittttttttttt";
print_r($_POST);
echo "<br>";

$stmt = $pdo ->prepare('SELECT * FROM tasks WHERE id = :id');
$stmt ->execute(['id'=> $_POST['id']]);
$task = $stmt ->fetch();

print_r($task);

echo '<form method="POST" action="edit_task.php">
          <input type="hidden" name="id"; value="'.$task['id'].'">
          <input type="text" name="title" value="'.$task['title'].'">
          <button type="submit" name="edit-task">ویرایش </button>
        </form>';


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['title'])) {
    $stmt = $pdo -> prepare("UPDATE tasks SET title = :title WHERE id = :id");
    $stmt -> execute(['id' => $_POST['id'], 'title'=> $_POST['title']]);
    
    header('Location: index.php');
    exit;
}

?>
