<?php
require_once '../include/db.php';
require_once '../include/auth.php';
require_admin();

$id = $_GET['id'];
$conn->query("DELETE FROM candidates WHERE candidate_id=$id");
header("Location: admin_dashboard.php");
exit;
?>
