<?php
require_once '../include/db.php';
require_once '../include/auth.php';
require_admin();

$id = $_GET['id'];
$candidate = $conn->query("SELECT * FROM candidates WHERE candidate_id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $party = $_POST['party'];
    $desc = $_POST['description'];

    $stmt = $conn->prepare("UPDATE candidates SET name=?, party=?, description=? WHERE candidate_id=?");
    $stmt->bind_param("sssi", $name, $party, $desc, $id);
    $stmt->execute();
    header("Location: admin_dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Candidate</title></head>
<body>
<h2>Edit Candidate</h2>
<form method="POST">
    Name: <input type="text" name="name" value="<?= $candidate['name'] ?>"><br><br>
    Party: <input type="text" name="party" value="<?= $candidate['party'] ?>"><br><br>
    Description: <textarea name="description"><?= $candidate['description'] ?></textarea><br><br>
    <button type="submit">Save Changes</button>
</form>
<a href="admin_dashboard.php">Back</a>
</body>
</html>
