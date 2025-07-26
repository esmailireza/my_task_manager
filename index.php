<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Tasks</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div>
    <h1>My Tasks</h1>
    <form action="add_task.php" method="POST">
      <input type="text" name="title" placeholder="تسک جدید اضافه کن..." required>
      <button type="submit">+</button>
    </form>
    <form method="GET" action="index.php" style="margin:10px 0px;">
      <input type="search" name="search" placeholder="تسک مورد نظر رو سرچ کن!">
        <button type="submit">جستجو</button>
    </form>

    <div style="margin-top: 30px;">
    <?php

    if(isset($_GET['search']) && !empty(trim($_GET['search']))){
      $stmt = $pdo->prepare("SELECT * FROM tasks WHERE title LIKE :search ORDER BY created_at DESC");
      $stmt -> execute(['search'=> '%'.$_GET["search"].'%']);
      while ($task = $stmt ->fetch()) {
        # code...
        echo '<div style="display: flex; justify-content: space-between; align-items: center; width: 300px; margin-bottom:10px; border:1px solid gray; padding:8px; border-raduis:20px;">';
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
      }else {

      $stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
      while ($task = $stmt ->fetch()) {
        # code...
        echo '<div style="display: flex; justify-content: space-between; align-items: center; width: 300px; margin-bottom:10px; border:1px solid gray; padding:8px; border-raduis:20px;">';
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
  }
    ?>
  </div>
  </div>

</body>
</html>