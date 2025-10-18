<?php
require_once '../include/db.php';
require_once '../include/auth.php';

// ✅ Ensure only admin can access this page
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim input values to remove extra spaces
    $name = trim($_POST['name']);
    $party = trim($_POST['party']);
    $desc = trim($_POST['description']);

    // ✅ Basic validation
    if (empty($name)) {
        $error = "Candidate name is required.";
    } else {
        // ✅ Insert candidate record safely
        $stmt = $conn->prepare("INSERT INTO candidates (name, party, description) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $name, $party, $desc);

            if ($stmt->execute()) {
                // ✅ Redirect with success message
                header("Location: admin_dashboard.php?success=CandidateAdded");
                exit;
            } else {
                $error = "Error adding candidate: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Database prepare failed: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Candidate - Admin</title>
</head>
<body>
    <h2>Add New Candidate</h2>

    <?php if(isset($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>
            Name:<br>
            <input type="text" name="name" required>
        </label>
        <br><br>

        <label>
            Party:<br>
            <input type="text" name="party">
        </label>
        <br><br>

        <label>
            Description:<br>
            <textarea name="description" rows="4" cols="40"></textarea>
        </label>
        <br><br>

        <button type="submit">Add Candidate</button>
    </form>

    <br>
    <a href="admin_dashboard.php">← Back to Dashboard</a>
</body>
</html>
