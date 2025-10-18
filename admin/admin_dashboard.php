<?php
require_once '../include/db.php';
require_once '../include/auth.php';
require_admin();

$candidates = $conn->query("SELECT * FROM candidates ORDER BY votes DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
<h2>Admin Dashboard</h2>
<a href="add_candidate.php">Add Candidate</a> | 
<a href="../logout.php">Logout</a>

<h3>Candidate List</h3>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Name</th><th>Party</th><th>Votes</th><th>Actions</th></tr>
<?php while($row = $candidates->fetch_assoc()): ?>
<tr>
  <td><?= $row['candidate_id'] ?></td>
  <td><?= htmlspecialchars($row['name']) ?></td>
  <td><?= htmlspecialchars($row['party']) ?></td>
  <td><?= $row['votes'] ?></td>
  <td>
    <a href="edit_candidate.php?id=<?= $row['candidate_id'] ?>">Edit</a> |
    <a href="delete_candidate.php?id=<?= $row['candidate_id'] ?>">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
