<?php

// Include necessary files
include '../../js/controller.php';
include '../../js/data.php';
include '../../js/logAll.php'; // Include the print history
session_start();

// Retrieve the current student's print history
$student = getSessionVariables('student');
$pages = $student->pages; // Remaining pages

// Filter print history for the current student
$userPrintHistory = array_filter($printHistory, function($entry) use ($student) {
    return $entry['id'] == $student->id;
});

// Retrieve search inputs
$msmi = isset($_GET['msmi']) ? trim($_GET['msmi']) : '';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Convert dates to timestamps if provided
$start_timestamp = $start_date ? strtotime($start_date . ' 00:00:00') : null;
$end_timestamp = $end_date ? strtotime($end_date . ' 23:59:59') : null;

// Filter the print history based on inputs
$filteredHistory = array_filter($userPrintHistory, function($entry) use ($msmi, $start_timestamp, $end_timestamp) {
    $match = true;

    // Filter by MSMI
    if ($msmi !== '' && stripos($entry['msmi'], $msmi) === false) {
        $match = false;
    }

    // Filter by date range
    $entryTimestamp = strtotime($entry['time']); // Assuming 'time' holds the date and time of the print job
    if ($start_timestamp && $entryTimestamp < $start_timestamp) {
        $match = false;
    }
    if ($end_timestamp && $entryTimestamp > $end_timestamp) {
        $match = false;
    }

    return $match;
});

// Pagination logic
$entriesPerPage = 10;
$totalEntries = count($filteredHistory);
$totalPages = ceil($totalEntries / $entriesPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($currentPage - 1) * $entriesPerPage;
$endIndex = min($startIndex + $entriesPerPage, $totalEntries);
$currentEntries = array_slice($filteredHistory, $startIndex, $entriesPerPage);

// Calculate total pages used by the student
$totalPagesUsed = 0;
foreach ($userPrintHistory as $entry) {
    if (preg_match('/(\d+)\s*x\s*(A[3-4])/', $entry['total_pages'], $matches)) {
        $pagesUsed = intval($matches[1]);
        $totalPagesUsed += $pagesUsed;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử in - Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/background.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/student.css">
    <style>
        .history-container {
            width: 100%;
            max-width: 1308px;
            margin: 176px auto;
            margin-bottom: 0px;
            text-align: center;
        }

        .search-filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-group label {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
            white-space: nowrap;
            margin-right: 25px;
        }

        .filter-group input {
            width: 97px;
        }

        .filter-group:nth-child(2) input {
            width: 61px;
        }

        .filter-group:nth-child(3) input {
            width: 146px;
        }

        .filter-group .MSMI {
            width: 60px;
        }

        .filter-group .time {
            width: 145px;
        }

        .filter-group span {
            margin: 0px 9.5px 0px 9.5px;
        }

        .log-table {
            width: 100%;
            margin: 0px auto;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
        }

        .table-header {
            display: grid;
            grid-template-columns: 1fr 1fr 1.5fr 1fr 1fr 1.5fr;
            border-bottom: 1px solid #D9D9D9;
            text-align: center;
            padding: 40px 20px 40px 20px;
        }

        .table-header span {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
        }

        .table-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1.5fr 1fr 1fr 1.5fr;
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
            margin: 50px 0px;
            margin-bottom: 0px;
        }

        .pagination button {
            width: 31.15px;
            height: 26.98px;
            background: transparent;
            transition-duration: 0.3s;
            border: none;
            cursor: pointer;
        }

        .pagination button:hover {
            background-color: #FFBF00;
        }

        .pagination button img {
            display: block;
            width: 17px;
            height: 17px;
            margin-left: auto;
            margin-right: auto;
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

        .total-pages-used {
            font-family: 'Inter';
            font-weight: 700;
            font-size: 21.36px;
            color: #000000;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include '../background.php'; ?>

    <script>
        const printBtn = document.querySelector(".nav-buttons .nav-btn-history");
        printBtn.style.background = "#004787";
        printBtn.style.pointerEvents = "none";
        printBtn.style.cursor = "default";
        const hcmutBtn = document.querySelector(".hcmut-spss");
        hcmutBtn.style.pointerEvents = "auto";
        hcmutBtn.style.cursor = "pointer";
        hcmutBtn.style.background = "transparent";
    </script>

    <div class="history-container">
        <div class="total-pages-used">
            
            Tổng số trang đã sử dụng: <?php echo $totalPagesUsed; ?>
        </div>
        <form method="GET" class="search-filters">
            <div class="filter-group">
                <label>Phạm vi thời gian:</label>
                <input type="text" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>" onchange="this.form.submit()">
                <span>-</span>
                <input type="text" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>" onchange="this.form.submit()">
            </div>   
            <div class="filter-group">
                <label>Mã số máy in:</label>
                <input type="text" name="msmi" placeholder="MSMI" value="<?php echo htmlspecialchars($msmi); ?>" onchange="this.form.submit()">
            </div>
        </form>

        <div class="log-table">
            <div class="table-header">
                <span>Thời gian</span>
                <span>MSSV</span>
                <span>Tên</span>
                <span>Số trang</span>
                <span>MSMI</span>
                <span>Tên tệp</span>
            </div>
            <?php foreach ($currentEntries as $entry): ?>
            <div class="table-row">
                <span><?php echo $entry['time']; ?></span>
                <span><?php echo $entry['id']; ?></span>
                <span><?php echo $entry['name']; ?></span>
                <span><?php echo $entry['total_pages']; ?></span>
                <span><?php echo $entry['msmi']; ?></span>
                <span><?php echo $entry['docname']; ?></span>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination">
            <?php if ($currentPage > 1): ?>
            <a href="?page=1" class="first-page">
                <img src="../../css/assets/left-two-arrows.png" alt="first page">
            </a>
            <a href="?page=<?php echo $currentPage - 1; ?>" class="prev-page">
                <img src="../../css/assets/left-arrow.png" alt="prev page">
            </a>
            <?php endif; ?>
            <div class="page-number"><?php echo $currentPage; ?> / <?php echo $totalPages; ?></div>
            <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?php echo $currentPage + 1; ?>" class="next-page">
                <img src="../../css/assets/right-arrow.png" alt="next page">
            </a>
            <a href="?page=<?php echo $totalPages; ?>" class="last-page">
                <img src="../../css/assets/right-two-arrows.png" alt="last page">
            </a>
            <?php endif; ?>
        </div>
    </div>

    <?php include '../footer.php'; ?>
</body>
</html>