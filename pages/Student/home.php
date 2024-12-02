<?php
/* Session checks here */
// Initialize student pages if not already set

include '../../js/controller.php';
include '../../js/data.php';
session_start();
$student =  getSessionVariables('student');
$pages = $student->pages;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Homepage</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/student.css">
    <style>
        /* Hero Section */
        .hero {
            position: relative;
            width: 100%;
            height: 622px;
            margin-top: 0px;
            background: url('../../css/assets/hero_3_cropped.webp');
            background-size: 100%;
            background-repeat: no-repeat;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .advertisement {
            position: absolute;
            width: 874px;
            height: 307px;
            left: 53px;
            top: 73px;
            background: rgba(0, 0, 0, 0.5);
        }

        .advertisement span {
            position: absolute;
            margin-top: 38px;
            margin-left: 14px;
            width: 845px;
            font-weight: 700;
            font-size: 64px;
            line-height: 77px;
            text-shadow:
                -1px -1px 0 #000,  
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000;
            color: #FFFFFF;
            /* border: 1px solid #000000; */
        }

        .start-print-btn {
            position: absolute;
            width: 246px;
            height: 69px;
            left: 53px;
            top: 453px;
            background: #0F6CBF;
            border-radius: 30px;
            border: none;
            font-weight: 700;
            font-size: 40px;
            color: #FFFFFF;
            cursor: pointer;
        }

        /* Action Cards */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(3, 418px);
            gap: 0px;
            justify-content: center;
            margin-top: 200px;
            /* cursor: pointer; */
        }

        .action-card {
            box-sizing: border-box;
            width: 418px;
            height: 329px;
            background: #FFFFFF;
            border: 1px solid #000000;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 27px;
            cursor: pointer;
        }

        .action-card span {
            font-weight: 700;
            font-size: 36.1046px;
            line-height: 44px;
            color: #000000;
        }

        .action-card img {
            width: 127px;
            height: 127px;
            margin: 32px 0;
        }

        .action-card p {
            width: 365px;
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
            text-align: center;
            color: #000000;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero">
            <div class="advertisement">
                <span>Dịch vụ in ấn thông minh, tiện lợi, nhanh chóng và dễ dàng</span>
            </div>
            <button class="start-print-btn" onclick="window.location.href='print.php'">Bắt đầu in</button>
        </section>

        <!-- Action Cards -->
        <section class="action-buttons">
            <div class="action-card" onclick="window.location.href='print.php'">
                <span>In</span>
                <img src="../../css/assets/printer-88.svg" alt="Print">
                <p>Bắt đầu in tài tiệu của bạn ngay!</p>
            </div>
            <div class="action-card" onclick="window.location.href='buy_pages.php'">
                <span>Mua trang</span>
                <img src="../../css/assets/paper.png" alt="Buy Pages">
                <p>Mua thêm trang với giá rẻ phù hợp với nhu cầu.</p>
            </div>
            <div class="action-card" onclick="window.location.href='print_history.php'">
                <span>Lịch sử in</span>
                <img src="../../css/assets/transaction-history.png" alt="Print History">
                <p>Xem lại những lần in trước đó của bản thân.</p>
            </div>
        </section>
    </main>

    <?php include '../footer.php'; ?>
</body>
</html>