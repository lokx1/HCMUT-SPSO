<?php
/* Session checks here */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử in - SPSO</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/SPSO.css">
    <style>
        .history-container {
            position: relative;
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            padding-top: 153px;
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

        .search-filters {
            display: flex;
            justify-content: space-between;
            width: 1307px; /* Match table width */
            margin: 133px auto 36px;
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

        .filter-group input {
            height: 55px;
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 10px;
            padding: 0 20px;
            font-size: 21.98px;
        }

        /* MSSV filter */
        .filter-group:nth-child(1) input {
            width: 137px;
        }

        /* MSMI filter */
        .filter-group:nth-child(2) input {
            width: 101px;
        }

        /* Date range filter */
        .filter-group:nth-child(3) {
            gap: 10px;
        }

        .filter-group:nth-child(3) input {
            width: 186px;
        }

        .log-table {
            width: 1307px;
            margin: 0 auto;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            padding: 44px;
        }

        .table-header {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1.5fr 1fr 1fr 1.5fr;
            padding: 0 20px;
            margin-bottom: 44px;
        }

        .table-header span {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
        }

        .table-row {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1.5fr 1fr 1fr 1.5fr;
            padding: 20px;
            border-top: 1px solid #D9D9D9;
        }

        .table-row span {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
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
            font-family: 'Inter';
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
            top: 200px;
        }

        .decoration-bottom {
            left: -193px;
            top: 664px;
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

        <div class="search-filters">
            <div class="filter-group">
                <label>Mã số sinh viên:</label>
                <input type="text" placeholder="MSSV">
            </div>
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
                <span>MSSV</span>
                <span>Tên</span>
                <span>Số trang</span>
                <span>MSMI</span>
                <span>Tên tệp</span>
            </div>
            <!-- Sample data rows -->
            <div class="table-row">
                <span>12:58:03 01/11/2024</span>
                <span>2252416</span>
                <span>Lionel Messi</span>
                <span>8 x A4</span>
                <span>0650</span>
                <span>AnkaraMessi.docx</span>
            </div>
            <div class="table-row">
                <span>13:02:46 29/10/2024</span>
                <span>2252932</span>
                <span>Cristiano Ronaldo</span>
                <span>5 x A4</span>
                <span>0953</span>
                <span>Siuuuuuuuuuuu.pdf</span>
            </div>
            <!-- Add more rows as needed -->
        </div>

        <div class="pagination">
            <button class="first-page">⟪</button>
            <button class="prev-page">⟨</button>
            <div class="page-number">1 / 3</div>
            <button class="next-page">⟩</button>
            <button class="last-page">⟫</button>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>