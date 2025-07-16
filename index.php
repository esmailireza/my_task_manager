<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Tasks</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>My Tasks</h1>

  <form action="add_task.php" method="POST">
    <input type="text" name="title" placeholder="New task..." required>
    <button type="submit">Add</button>
  </form>

  <ul>
    <?php
      $stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
      while ($task = $stmt ->fetch()) {
        # code...
        echo '<div style="display: flex; justify-content: space-between; align-items: center; width: 200px;">';
        echo $task['is_done']? '<s>' . htmlspecialchars($task['title']) . '</s>' : htmlspecialchars($task['title']);
        echo '<form method="POST" action="delete_task.php" style="margin:0px;">
          <input type="hidden" name="id"; value="'.$task['id'].'">
          <button type="submit" name="delete-task" style="margin-left:10px;">حذف </button>
        </form>';
        echo '</div>';
      }
    ?>
  </ul>
</body>
</html>