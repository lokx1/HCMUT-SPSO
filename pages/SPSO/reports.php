<?php
/* Session checks here */
include '../../js/logAll.php'; // Include the print history

// Function to calculate total pages printed
function calculateTotalPages($entries) {
    $totalPages = 0;
    foreach ($entries as $entry) {
        if (preg_match('/(\d+)\s*x\s*(A[3-4])/', $entry['total_pages'], $matches)) {
            $pages = intval($matches[1]);
            $totalPages += ($matches[2] === 'A3') ? $pages * 2 : $pages;
        }
    }
    return $totalPages;
}

// Function to group entries by 3-month periods
function groupByQuarter($entries) {
    $grouped = [];
    foreach ($entries as $entry) {
        $time = DateTime::createFromFormat('H:i:s d/m/Y', $entry['time']);
        $quarter = ceil($time->format('n') / 3);
        $year = $time->format('Y');
        $key = "$year-Q$quarter";
        if (!isset($grouped[$key])) {
            $grouped[$key] = [];
        }
        $grouped[$key][] = $entry;
    }
    return $grouped;
}

// Add this function after the existing PHP functions
function getAvailableQuarters($printHistory) {
    $quarters = [];
    foreach ($printHistory as $entry) {
        $time = DateTime::createFromFormat('H:i:s d/m/Y', $entry['time']);
        if ($time) {
            $quarter = ceil($time->format('n') / 3);
            $year = $time->format('Y');
            $quarterKey = "$year-Q$quarter";
            if (!in_array($quarterKey, $quarters)) {
                $quarters[] = $quarterKey;
            }
        }
    }
    rsort($quarters); // Sort in descending order
    return $quarters;
}

// Group entries by 3-month periods
$groupedEntriesByQuarter = groupByQuarter($printHistory);

// Calculate total pages for each student in each period
$summaryByQuarter = [];
foreach ($groupedEntriesByQuarter as $period => $entries) {
    foreach ($entries as $entry) {
        $id = $entry['id'];
        $name = $entry['name'];
        if (!isset($summaryByQuarter[$period][$id])) {
            $summaryByQuarter[$period][$id] = [
                'name' => $name,
                'total_pages' => 0
            ];
        }
        $summaryByQuarter[$period][$id]['total_pages'] += calculateTotalPages([$entry]);
    }
}

// Get available quarters
$availableQuarters = getAvailableQuarters($printHistory);
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
        }

        .report-container {
            position: relative;
            width: 1244px;
            height: 712px;
            left: calc(50% - 1244px/2);
            top: 186px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #000000;
            margin-bottom: 200px;
        }

        .time-option {
            position: absolute;
            width: 220px;
            height: 55px;
            top: 56px;
            left: 49px;
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

        .stats-container {
            position: absolute;
            right: 49px;
            top: 140px;
            display: flex;
            flex-direction: column;
            gap: 46px;
            padding-bottom: 0px;
        }

        .stat-card {
            width: 270px;
            height: 118.04px;
            background: #FFBF00;
            opacity: 0.8;
            border: 0.7px solid #FFBF00;
            color: #FFFFFF;
            text-align: center;
        }

        .stat-title {
            font-family: 'Roboto';
            font-size: 16.96px;
            margin-top: 19.79px;
        }

        .stat-value {
            font-family: 'Roboto';
            font-weight: 700;
            font-size: 33.93px;
            margin-top: 18.17px;
        }

        #report-content {
            width: 758px;
            margin: 154px 0 0 147px;
        }

        #report-content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: white;
            font-family: 'Inter';
        }

        #report-content th, 
        #report-content td {
            padding: 15px;
            text-align: left;
            border: 1px solid #D9D9D9;
        }

        #report-content th {
            background-color: #0F6CBF;
            color: white;
            font-weight: normal;
        }

        #report-content h3 {
            font-family: 'Inter';
            font-size: 20px;
            color: #000000;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
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
                <?php foreach ($availableQuarters as $quarter): ?>
                    <option value="<?php echo $quarter; ?>"><?php echo $quarter; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="report-content">
            <!-- Content will be populated by JavaScript -->
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
        function updateReport(selectedQuarter) {
            const reportContent = document.getElementById('report-content');
            const summary = <?php echo json_encode($summaryByQuarter); ?>;
            
            if (summary[selectedQuarter]) {
                const students = summary[selectedQuarter];
                reportContent.innerHTML = `
                    <h3>${selectedQuarter}</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Tổng số trang</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${Object.entries(students).map(([id, data]) => `
                                <tr>
                                    <td>${id}</td>
                                    <td>${data.name}</td>
                                    <td>${data.total_pages}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                `;
            }
        }

        document.getElementById('reportType').addEventListener('change', function() {
            updateReport(this.value);
        });

        // Initial load
        document.addEventListener('DOMContentLoaded', function() {
            const firstQuarter = document.getElementById('reportType').value;
            updateReport(firstQuarter);
        });
    </script>
</body>
</html>