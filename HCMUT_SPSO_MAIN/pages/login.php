") {
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
        // Create a new Student object with new data
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
        
        <form method="POST">
            <input type="text" class="input-field" id="username" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" class="input-field" id="password" name="password" placeholder="Mật khẩu" required>
            
            <button type="submit" class="button login-btn">
                <span>Đăng nhập</span>
            </button>
            <button type="button" class="button admin-btn">
                <span>Admin</span>
            </button>
            <a href="#" class="forgot-password">Thay đổi mật khẩu?</a>
        </form>
    </div>

    <script src="../js/main.js"></script>
</body>
</html>