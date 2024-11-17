<?php
/* Session checks here */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo - SPSO</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/SPSO.css">
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
            min-height: calc(100vh + 800px); /* Increase minimum height */
        }

        .report-container {
            position: relative;
            width: 1244px;
            height: 900px; /* Increase height to fit all content */
            left: calc(50% - 1244px/2);
            top: 286px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #000000;
            margin-bottom: 400px; /* Increase margin to push content down */
        }

        .time-option {
            position: absolute;
            width: 220px;
            height: 55px;
            left: 147px;
            top: -56px;
        }

        .time-select {
            width: 220px;
            height: 55px;
            background: #0F6CBF;
            border: 1px solid #000000;
            border-radius: 10px;
            color: #FFFFFF;
            font-family: 'Inter';
            font-size: 21.98px;
            padding: 0 20px;
            cursor: pointer;
        }

        .chart-container {
            width: 758px;
            height: 500.42px;
            margin: 154px 0 0 147px;
        }

        .stats-container {
            position: absolute;
            right: 147px;
            top: 140px;
            display: flex;
            flex-direction: column;
            gap: 46px;
            padding-bottom: 40px; /* Add padding to prevent overlap with container border */
        }

        .stat-card {
            width: 270px;
            height: 118.04px;
            background: #FFBF00;
            opacity: 0.8;
            border: 0.7px solid #FFBF00;
            padding: 20px;
            color: #FFFFFF;
            text-align: center;
        }

        .stat-title {
            font-family: 'Roboto';
            font-size: 16.96px;
            margin-bottom: 20px;
        }

        .stat-value {
            font-family: 'Roboto';
            font-weight: 700;
            font-size: 33.93px;
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
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="decoration decoration-top"></div>
    <div class="decoration decoration-bottom"></div>

    <button onclick="window.location.href='home.php'" class="back-to-home">
        <span>←</span>
        <span>Back to home</span>
    </button>

    <div class="report-container">
        <div class="time-option">
            <select class="time-select" id="reportType">
                <option value="year">Báo cáo năm</option>
                <option value="month">Báo cáo tháng</option>
            </select>
        </div>

        <div class="chart-container">
            <!-- Chart will be rendered here -->
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-title">Tổng doanh thu</div>
                <div class="stat-value">220k</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Tổng số trang đã sử dụng</div>
                <div class="stat-value">110</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Tổng số học sinh sử dụng dịch vụ</div>
                <div class="stat-value">40</div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        document.getElementById('reportType').addEventListener('change', function() {
            // Handle chart update based on selection
            const reportType = this.value;
            // Update chart data and display
        });
    </script>
</body>
</html>