<?php
/* Session checks here */
include '../../js/logAll.php';

// Pagination logic
$entriesPerPage = 10;
$totalEntries = count($printHistory);
$totalPages = ceil($totalEntries / $entriesPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($currentPage - 1) * $entriesPerPage;
$endIndex = min($startIndex + $entriesPerPage, $totalEntries);
$currentEntries = array_slice($printHistory, $startIndex, $entriesPerPage);

// Search functionality
$searchMSSV = isset($_GET['mssv']) ? $_GET['mssv'] : '';
$searchMSMI = isset($_GET['msmi']) ? $_GET['msmi'] : '';
$searchStartDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$searchEndDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

if ($searchMSSV || $searchMSMI || $searchStartDate || $searchEndDate) {
    $filteredEntries = array_filter($printHistory, function($entry) use ($searchMSSV, $searchMSMI, $searchStartDate, $searchEndDate) {
        $matchMSSV = !$searchMSSV || strpos($entry['id'], $searchMSSV) !== false;
        $matchMSMI = !$searchMSMI || strpos($entry['msmi'], $searchMSMI) !== false;
        $matchStartDate = !$searchStartDate || strtotime($entry['time']) >= strtotime($searchStartDate);
        $matchEndDate = !$searchEndDate || strtotime($entry['time']) <= strtotime($searchEndDate);
        return $matchMSSV && $matchMSMI && $matchStartDate && $matchEndDate;
    });
    $totalEntries = count($filteredEntries);
    $totalPages = ceil($totalEntries / $entriesPerPage);
    $currentEntries = array_slice($filteredEntries, $startIndex, $entriesPerPage);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử in - SPSO</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/background.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/SPSO.css">
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
            margin-bottom: 16px;
        }

        .filter-group {
            margin-left: auto;
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

        .filter-group:nth-child(3) {
            gap: 10px;
        }

        .filter-group:nth-child(3) input {
            width: 146px;
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
            border-top: 1px solid #D9D9D9;
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
            margin-bottom: 0px;
        }

        .pagination a {
            width: 31.15px;
            height: 26.98px;
            background: transparent;
            transition-duration: 0.3s;
            border: none;
            cursor: pointer;
        }

        .pagination a:hover {
            background-color: #FFBF00;
        }

        .pagination a img {
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
            font-family: 'Inter';
            font-weight: 700;
            font-size: 21.36px;
            text-align: center;
            line-height: 31px;
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

    <div class="history-container">
        <form method="GET" class="search-filters">
            <div class="filter-group">
                <label>Mã số sinh viên:</label>
                <input type="text" name="mssv" placeholder="MSSV" value="<?php echo htmlspecialchars($searchMSSV); ?>" onchange="this.form.submit()">
            </div>
            <div class="filter-group">
                <label>Mã số máy in:</label>
                <input type="text" name="msmi" placeholder="MSMI" value="<?php echo htmlspecialchars($searchMSMI); ?>" onchange="this.form.submit()">
            </div>
            <div class="filter-group">
                <label>Phạm vi thời gian:</label>
                <input type="text" name="start_date" placeholder="DD/MM/YYYY" value="<?php echo htmlspecialchars($searchStartDate); ?>" onchange="this.form.submit()">
                <span>-</span>
                <input type="text" name="end_date" placeholder="DD/MM/YYYY" value="<?php echo htmlspecialchars($searchEndDate); ?>" onchange="this.form.submit()">
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