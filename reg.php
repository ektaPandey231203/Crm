<?php
session_start();
include 'CSRF_Token.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LJ University - Sign Up</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e90ff, #6dd5fa, #ffffff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signup-box {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
            width: 420px;
            transition: 0.3s;
        }

        .signup-box:hover {
            transform: translateY(-5px);
        }

        .signup-box img {
            max-height: 90px;
            margin-bottom: 15px;
        }

        .signup-box h3 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .input-group-text {
            background: #f1f1f1;
            border-right: none;
        }

        .form-control {
            border-left: none;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .btn-primary {
            background: #007bff;
            border: none;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: scale(1.02);
        }

        .footer-text {
            font-size: 14px;
            margin-top: 15px;
            color: #555;
        }

        .footer-text a {
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- Error Alert -->
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show m-3 text-capitalize w-50 mx-auto" role="alert">
            <strong>Oops!</strong> <?= $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="signup-box text-center">
        <img src="assets/images/lj_logo.png" alt="Logo">
        <h3><i class="fa-solid fa-user-plus me-2"></i>Sign Up</h3>

        <form action="connect.php" method="post" id="regForm">

            <!-- Username -->
            <label for="user" class="form-label">Username</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                <input type="text" id="user" name="user" class="form-control" placeholder="Enter username" required>
            </div>

            <!-- Email -->
            <label for="email" class="form-label">Email</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required>
            </div>

            <!-- Password -->
            <label for="pass" class="form-label">Password</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter password" required>
            </div>

            <!-- Confirm Password -->
            <label for="cpass" class="form-label">Confirm Password</label>
            <div class="input-group mb-4">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" id="cpass" name="cpass" class="form-control" placeholder="Re-enter password" required>
            </div>

            <!-- Hidden CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

            <!-- Submit -->
            <button class="btn btn-primary w-100" type="submit">Register</button>

            <!-- Footer -->
            <p class="footer-text">
                <i class="fa-solid fa-code me-1"></i> Developed by: <a href="#">Mihir Vaghela</a>
            </p>
            <p class="footer-text">
                Already have an account? <a href="index.php">Login</a>
            </p>
        </form>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

</body>
</html>
