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
        echo '<form method="POST" action="toggle_done.php">
          <input type="hidden" name="id"; value="'.htmlspecialchars($task['id']).'">
          <input type="checkbox" name="is_done" onchange="this.form.submit()"'.($task['is_done'] ? 'checked' : '').'>
        </form>';
        echo $task['is_done']? '<s style="color:gray;">' . htmlspecialchars($task['title']) . '</s>' : htmlspecialchars($task['title']);
        echo '<form method="POST" action="delete_task.php" style="margin:0px;">
          <input type="hidden" name="id"; value="'.htmlspecialchars($task['id']).'">
          <button type="submit" name="delete-task">حذف </button>
        </form>';
        echo '<form method="POST" action="edit_task.php">
        <input type="hidden" name="id" value="'.htmlspecialchars($task['id']).'">
        <button type="submit" name="edit-task">ویرایش</button>
        </form>';
        echo '</div>';
      }
    ?>
  </ul>
</body>
</html>