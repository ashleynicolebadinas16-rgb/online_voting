<?php
require_once 'include/db.php';
session_start();

/////////////////////////////
// 1️⃣ Ensure admin exists //
/////////////////////////////
$hashedPassword = password_hash('admin12345', PASSWORD_DEFAULT);
$username = 'admin';
$fullname = 'Admin User';
$role = 'admin';

// Check if admin already exists
$check = $conn->prepare("SELECT * FROM users WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$result = $check->get_result();

if ($result->num_rows == 0) {
    // Create admin if not found
    $insert = $conn->prepare("INSERT INTO users (username, password, fullname, role) VALUES (?, ?, ?, ?)");
    $insert->bind_param("ssss", $username, $hashedPassword, $fullname, $role);
    $insert->execute();
}

/////////////////////////////////////
// 2️⃣ Handle user login (POST)    //
/////////////////////////////////////
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Look up user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: admin/admin_dashboard.php");
            } else {
                header("Location: voter/voter_dashboard.php");
            }
            exit;
        } else {
            $error = "❌ Invalid password.";
        }
    } else {
        $error = "❌ Username not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Online Voting System</title>
</head>
<body>
<h2>Login</h2>

<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="voter/voter_register.php">Register here</a></p>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

</body>
</html>
