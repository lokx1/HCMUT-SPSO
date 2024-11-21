<?php
/* Session checks here */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo - SPSO</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/background.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/footer.css">
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
            /*min-height: calc(100vh + 800px); /* Increase minimum height */
        }

        .report-container {
            position: relative;
            width: 1244px;
            height: 682px; /* Increase height to fit all content */
            left: calc(50% - 1244px/2);
            top: 186px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #000000;
            margin-bottom: 200px; /* Increase margin to push content down */
        }

        .time-option {
            position: absolute;
            width: 220px;
            height: 55px;
            top: 56px;
            left: 49px;
            /* background: #0F6CBF; */
            /* left: 147px; */
            /* top: -56px; */
        }

        .time-select {
            width: 220px;
            height: 55px;
            border: 1px solid #000000;
            background-color: #0F6CBF;
            color: #FFFFFF;
            appearance: none;
            background-image: url("../../css/assets/white-down-arrow.png");
        }

        .chart-container {
            width: 758px;
            height: 500.42px;
            margin: 154px 0 0 147px;
        }

        .stats-container {
            position: absolute;
            right: 49px;
            top: 140px;
            display: flex;
            flex-direction: column;
            gap: 46px;
            padding-bottom: 0px; /* Add padding to prevent overlap with container border */
        }

        .stat-card {
            width: 270px;
            height: 118.04px;
            background: #FFBF00;
            opacity: 0.8;
            border: 0.7px solid #FFBF00;
            /* padding: 20px; */
            color: #FFFFFF;
            text-align: center;
        }

        .stat-title {
            font-family: 'Roboto';
            font-size: 16.96px;
            /* margin-bottom: 20px; */
            margin-top: 19.79px;
        }

        .stat-value {
            font-family: 'Roboto';
            font-weight: 700;
            font-size: 33.93px;
            margin-top: 18.17px;
        }
    </style>
</head>
<body>
    <!-- <canvas id="myChart" style="width:100%;max-width:600px"></canvas> -->
    <?php include 'header.php'; ?>
    <?php include '../background.php'; ?>

    <script>
        const editBtn = document.querySelector(".xem .dropdown-btn");
        editBtn.style.background = "#004787";
        editBtn.style.pointerEvents = "none";
        editBtn.style.cursor = "default";
        const hcmutBtn = document.querySelector(".hcmut-spss");
        hcmutBtn.style.pointerEvents = "auto";
        hcmutBtn.style.cursor = "pointer";
        hcmutBtn.style.background = "transparent";
    </script>

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

    <?php include '../footer.php'; ?>

    <script>
        document.getElementById('reportType').addEventListener('change', function() {
            // Handle chart update based on selection
            const reportType = this.value;
            // Update chart data and display
        });
        
        
        // const xValues = [100,200,300,400,500,600,700,800,900,1000];

        // new Chart("myChart", {
        // type: "line",
        // data: {
        //     labels: xValues,
        //     datasets: [{ 
        //     // data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
        //     // borderColor: "red",
        //     // fill: false
        //     // }, { 
        //     // data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
        //     // borderColor: "green",
        //     // fill: false
        //     // }, { 
        //     data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
        //     borderColor: "#032B91",
        //     fill: false
        //     }]
        // },
        // options: {
        //     legend: {
        //         display: true,
        //         position: "bottom"
        //     }
        // }
        // });
    </script>
</body>
</html>