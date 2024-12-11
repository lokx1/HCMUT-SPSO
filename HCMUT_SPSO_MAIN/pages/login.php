<?php
include 'js/controller.php';
include 'js/data.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username === "admin" && $password === "password" && isset($_POST['admin_login'])) {
        $_SESSION['loggedin'] = true;
        header("Location: ./pages/SPSO/home.php");
        exit();
    }

    if ($username === "student" && $password === "password") {
        $_SESSION['loggedin'] = true;
        $student = initializeSessionVariables(2252442, 'Bảo Lê', 'password');
        $_SESSION['student'] = $student;
        header("Location: ./pages/Student/home.php");
        exit();
    }

    if ($username === "baolong" && $password === "password") {
        $_SESSION['loggedin'] = true;
        $student = initializeSessionVariables(223456, 'Baolong', 'password');
        $_SESSION['student'] = $student;
        header("Location: ./pages/Student/home.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dịch vụ in thông minh</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="decoration decoration-top"></div>
    <div class="decoration decoration-bottom"></div>

    <div class="login-container">
        <div class="logo"></div>
        <h1 class="title">Dịch vụ in thông minh</h1>
        
        <form method="POST" id="loginForm">
            <input type="text" class="input-field" id="username" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" class="input-field" id="password" name="password" placeholder="Mật khẩu" required>
            
            <button type="submit" class="button login-btn">
                <span>Đăng nhập</span>
            </button>
            <button type="button" class="button admin-btn" id="adminBtn">
                <span>Admin</span>
            </button>
            <a href="#" class="forgot-password">Thay đổi mật khẩu?</a>
        </form>
    </div>

    <script>
        document.getElementById('adminBtn').addEventListener('click', function() {
            const form = document.getElementById('loginForm');
            const adminInput = document.createElement('input');
            adminInput.type = 'hidden';
            adminInput.name = 'admin_login';
            adminInput.value = '1';
            form.appendChild(adminInput);
            form.submit();
        });
    </script>
</body>
</html>