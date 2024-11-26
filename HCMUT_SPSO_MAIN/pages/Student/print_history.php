<?php
session_start();

/* Include necessary files */
include '../../js/controller.php';
include '../../js/data.php';
include '../../js/logAll.php'; // Include the print history

$student = initializeSessionVariables();
$pages = $student->pages; // Remaining pages

// Filter print history for the current student
$userPrintHistory = array_filter($printHistory, function($entry) use ($student) {
    return $entry['id'] == $student->id;
});

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
        body {
            /* position: relative;
            width: 100%;
            min-height: 100vh;
            background: #FFFFFF;
            overflow-x: hidden;
            padding-top: 100px;
            display: flex;
            flex-direction: column;
            min-height: calc(100vh + 1200px); */
        }

        .history-container {
            /* position: relative; */
            width: 100%;
            max-width: 1308px;
            /* margin: 183px 0px 0px 66px; */
            margin: 183px auto;
            margin-bottom: 0px;
            text-align: center
            /* padding-top: 0px; */
        }

        .page-count-display {
            /* position: absolute; */
            display: flex;
            /* align-items: center; */
            /* gap: 0px; */
            /* margin-bottom: 20px; */
        }

        .page-count-display img {
            width: 65px;
            height: 64px;
        }

        .page-count-display span {
            width: 198px;
            font-family: 'Inter';
            font-style: italic;
            font-weight: 700;
            font-size: 24px;
            line-height: 24px;
            color: #F31260;
            text-align: left;
            padding-top: 7px;
        }

        .search-filters {
            display: flex; 
            /* justify-content: space-between; */
            /* width: 100%; */
            /* margin: 40px 0px 0px 20px; */
            /* padding: 0 20px; */
        }

        .filter-group {
            /* display: flex; */
            margin-left: auto;
            /* align-items: center; */
            /* gap: 25px; */
        }

        .filter-group label {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
            white-space: nowrap;
            margin-right: 25px;
        }
        

        .filter-group .MSMI {
            width: 60px; /* width is already 41px when set to 0px */
        }

        .filter-group .time {
            width: 145px; /* width is already 41px when set to 0px */
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
            /* padding: 44px; */
            
        }

        .table-header {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1.5fr;
            /* padding-left: 51px; */
            /* margin-bottom: 44px; */
            /* padding-left: 51px; */
            border-bottom: 1px solid #D9D9D9;
            text-align: center;
            /* padding-bottom: 20px; */
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
            margin: 50px 0px;
            margin-bottom: 0px;
        }

        .pagination button {
            width: 31.15px;
            height: 26.98px;
            /* background: #FFBF00; */
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

        /* .content-wrapper {
            margin-top: 131px;
        } */
    </style>
    </head>
    <body>
    <?php include 'header.php'; ?>
    <?php include '..\background.php'; ?>
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
        <div class="content-wrapper">
            <div class="search-filters">
                <div class="page-count-display">
                    <img src="../../css/assets/availablePaper.png" alt="Paper">
                    <span>Tổng số trang đã sử dụng: <?php echo $totalPagesUsed; ?></span>
                    
                </div>
                <div class="filter-group">
                    <label>Mã số máy in:</label>
                    <input class="MSMI" type="text" placeholder="MSMI">
                </div>
                <div class="filter-group">
                    <label class="time-label">Phạm vi thời gian:</label>
                    <input class="time" type="text" placeholder="DD/MM/YYYY">
                    <span>-</span>
                    <input class="time"type="text" placeholder="DD/MM/YYYY">
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
                <?php foreach ($userPrintHistory as $entry): ?>
                    <div class="table-row">
                        <span><?php echo htmlspecialchars($entry['time']); ?></span>
                        <span><?php echo htmlspecialchars($entry['building']); ?></span>
                        <span><?php echo htmlspecialchars($entry['room']); ?></span>
                        <span><?php echo htmlspecialchars($entry['total_pages']); ?></span>
                        <span><?php echo htmlspecialchars($entry['msmi']); ?></span>
                        <span><?php echo htmlspecialchars($entry['docname']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="pagination">
                <button class="first-page">
                    <img src="../../css/assets/left-two-arrows.png" alt="first page">
                </button>
                <button class="prev-page">
                    <img src="../../css/assets/left-arrow.png" alt="prev page">
                </button>
                <div class="page-number">1 / 3</div>
                <button class="next-page">
                    <img src="../../css/assets/right-arrow.png" alt="next page">
                </button>
                <button class="last-page">
                    <img src="../../css/assets/right-two-arrows.png" alt="last page">
                </button>
            </div>
        </div>
    </div>

    <?php include '..\footer.php'; ?>
</body>
</html>