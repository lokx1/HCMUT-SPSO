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
    <link rel="stylesheet" href="../../css/background.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/SPSO.css">
    <style>
        .history-container {
            /* position: relative; */
            width: 100%;
            max-width: 1308px;
            /* margin: 183px 0px 0px 66px; */
            margin: 176px auto;
            margin-bottom: 0px;
            text-align: center
            /* padding-top: 0px; */
        }

        .search-filters {
            display: flex;
            /* justify-content: space-between;
            width: 1307px; 
            margin: 133px auto 36px;
            padding: 0 20px; */
            margin-bottom: 16px;
        }

        .filter-group {
            /* display: flex;
            align-items: center;
            gap: 25px; */
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
            /* height: 55px;
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 10px;
            padding: 0 20px;
            font-size: 21.98px; */
        }

        /* MSSV filter */
        .filter-group:nth-child(1) input {
            width: 97px;
        }

        /* MSMI filter */
        .filter-group:nth-child(2) input {
            width: 61px;
        }

        /* Date range filter */
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
            /* padding: 44px; */
        }

        .table-header {
            display: grid;
            grid-template-columns: 1fr 1fr 1.5fr 1fr 1fr 1.5fr;
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

    <?php include '../footer.php'; ?>
</body>
</html>