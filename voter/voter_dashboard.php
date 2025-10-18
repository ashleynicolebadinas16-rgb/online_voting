<?php
require_once '../include/db.php';
require_once '../include/auth.php';
require_login();

$user_id = $_SESSION['user_id'];

$check = $conn->prepare("SELECT * FROM votes WHERE user_id=?");
$check->bind_param("i", $user_id);
$check->execute();
$voted = $check->get_result()->num_rows > 0;

$candidates = $conn->query("SELECT * FROM candidates");
?>
<!DOCTYPE html>
<html>
<head><title>Voter Dashboard</title></head>
<body>
<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<?php if ($voted): ?>
<p style="color:green;">You have already voted.</p>
<?php else: ?>
<form method="POST" action="vote.php">
    <h3>Select your candidate:</h3>
    <?php while ($row = $candidates->fetch_assoc()): ?>
        <input type="radio" name="candidate_id" value="<?= $row['candidate_id'] ?>" required>
        <?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['party']) ?>)<br>
    <?php endwhile; ?>
    <br><button type="submit">Submit Vote</button>
</form>
<?php endif; ?>
<br><a href="../logout.php">Logout</a>
</body>
</html>
