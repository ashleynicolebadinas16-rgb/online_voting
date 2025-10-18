<?php
require_once '../include/db.php';
require_once '../include/auth.php';
require_login();

$user_id = $_SESSION['user_id'];
$candidate_id = $_POST['candidate_id'] ?? null;

if ($candidate_id) {
    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO votes (user_id, candidate_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $candidate_id);
        $stmt->execute();

        $update = $conn->prepare("UPDATE candidates SET votes = votes + 1 WHERE candidate_id = ?");
        $update->bind_param("i", $candidate_id);
        $update->execute();

        $conn->commit();
        echo "<p>Vote successfully recorded!</p>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "<p style='color:red;'>Error: You may have already voted.</p>";
    }
}
echo '<a href="voter_dashboard.php">Back to Dashboard</a>';
?>
