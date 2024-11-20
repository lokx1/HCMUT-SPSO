<?php
/* Session checks here */
session_start();
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử in - Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/student.css">
    <style>
        body {
            position: relative;
            width: 100%;
            min-height: 100vh;
            background: #FFFFFF;
            overflow-x: hidden;
            padding-top: 100px;
            display: flex;
            flex-direction: column;
            min-height: calc(100vh + 1200px);
        }

        .history-container {
            position: relative;
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            padding-top: 153px;
        }

        .page-count-display {
            position: relative;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-left: 131px;
            margin-bottom: 20px;
        }

        .page-count-display img {
            width: 65px;
            height: 64px;
        }

        .page-count-display p {
            font-family: 'Inter';
            font-style: italic;
            font-weight: 700;
            font-size: 24px;
            color: #F31260;
        }

        .search-filters {
            display: flex;
            justify-content: space-between;
            width: 1307px;
            margin: 40px auto 20px;
            padding: 0 20px;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .filter-group label {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
            white-space: nowrap;
        }

        .log-table {
            width: 1307px;
            margin: 40px auto;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            padding: 44px;
        }

        .table-header {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1.5fr;
            padding: 0 20px;
            margin-bottom: 44px;
            border-bottom: 1px solid #D9D9D9;
            padding-bottom: 20px;
        }

        .table-header span {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
        }

        .table-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1.5fr;
            padding: 20px;
            border-bottom: 1px solid #D9D9D9;
        }

        .table-row span {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
            text-align: center;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 50px 0;
        }

        .pagination button {
            width: 31.15px;
            height: 26.98px;
            background: #FFBF00;
            border: none;
            cursor: pointer;
        }

        .pagination .page-number {
            width: 57.79px;
            height: 31px;
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 9.78px;
            font-weight: 700;
            font-size: 21.36px;
            text-align: center;
            line-height: 31px;
        }

        .decoration {
            position: fixed;
            width: 320px;
            height: 320px;
            background: #0F6CBF;
            border-radius: 50%;
            z-index: -1;
        }

        .decoration-top {
            right: -160px;
            top: 185px;
        }

        .decoration-bottom {
            left: -160px;
            top: 648px;
        }

        .back-to-home {
            position: absolute;
            width: 224px;
            height: 57px;
            left: 37px;
            top: 153px;
            background: #FFFFFF;
            border: 1px solid #000000;
            border-radius: 30px;
            font-family: 'Inter';
            font-weight: 400;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px;
            cursor: pointer;
        }

        .content-wrapper {
            margin-top: 133px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="decoration decoration-top"></div>
    <div class="decoration decoration-bottom"></div>

    <div class="history-container">
        <button onclick="window.location.href='home.php'" class="back-to-home">
            <span>←</span>
            <span>Back to home</span>
        </button>

        <div class="content-wrapper">
            <div class="page-count-display">
                <img src="../../css/assets/availablePaper.png" alt="Paper">
                <p>Tổng số trang đã sử dụng: 25</p>
            </div>

            <div class="search-filters">
                <div class="filter-group">
                    <label>Mã số máy in:</label>
                    <input type="text" placeholder="MSMI">
                </div>
                <div class="filter-group">
                    <label>Phạm vi thời gian:</label>
                    <input type="text" placeholder="DD/MM/YYYY">
                    <span>-</span>
                    <input type="text" placeholder="DD/MM/YYYY">
                </div>
            </div>

            <div class="log-table">
                <div class="table-header">
                    <span>Thời gian</span>
                    <span>Tòa nhà</span>
                    <span>Phòng</span>
                    <span>Số trang</span>
                    <span>MSMI</span>
                    <span>Tên tệp</span>
                </div>
                <div class="table-row">
                    <span>12:58:03 01/11/2024</span>
                    <span>A3</span>
                    <span>208</span>
                    <span>8 x A4</span>
                    <span>0650</span>
                    <span>AnkaraMessi.docx</span>
                </div>
                <div class="table-row">
                    <span>13:02:46 29/10/2024</span>
                    <span>A5</span>
                    <span>212</span>
                    <span>5 x A4</span>
                    <span>0953</span>
                    <span>Siuuuuuuuuuuu.pdf</span>
                </div>
                <div class="table-row">
                    <span>14:30:15 18/10/2024</span>
                    <span>B5</span>
                    <span>306</span>
                    <span>2 x A4 & 5 x A3</span>
                    <span>0470</span>
                    <span>OhYeah.doc</span>
                </div>
            </div>

            <div class="pagination">
                <button class="first-page">⟪</button>
                <button class="prev-page">⟨</button>
                <div class="page-number">1 / 3</div>
                <button class="next-page">⟩</button>
                <button class="last-page">⟫</button>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>