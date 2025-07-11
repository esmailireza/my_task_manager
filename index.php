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
        echo "<li>";
        echo $task['is_done']? '<s>' . htmlspecialchars($task['title']) . '</s>' : htmlspecialchars($task['title']);
        echo "</li>";
      }
    ?>
  </ul>
</body>
</html>