<?php
session_start();

// Only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php'); exit;
}

// CSRF check
if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'])) {
    $_SESSION['error'] = 'Form expired. Please try again.';
    header('Location: index.php'); exit;
}

$user = trim($_POST['user'] ?? '');
$pass = $_POST['pass'] ?? '';

if ($user === '' || $pass === '') {
    $_SESSION['error'] = 'Please fill all fields.';
    header('Location: index.php'); exit;
}

require_once 'db.php'; // must define $conn (mysqli)

if (!$conn) {
    $_SESSION['error'] = 'Database connection failed.';
    header('Location: index.php'); exit;
}

$sql = "SELECT id, username, email, pass FROM users WHERE email = ? OR username = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    $_SESSION['error'] = 'Server error. Please try later.';
    header('Location: index.php'); exit;
}

mysqli_stmt_bind_param($stmt, 'ss', $user, $user);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if ($res && ($row = mysqli_fetch_assoc($res))) {
    if (password_verify($pass, $row['pass'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = $row['username'];
        $_SESSION['last_activity'] = time();
        header('Location: home.php'); exit;
    }
}

$_SESSION['error'] = 'Invalid username or password.';
header('Location: index.php'); exit;
