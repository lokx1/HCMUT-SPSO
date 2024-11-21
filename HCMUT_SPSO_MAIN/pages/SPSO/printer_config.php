<?php
/* Session checks here */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tùy chọn in - SPSO</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/background.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/SPSO.css">
    <style>
        body {
            position: relative;
            width: 100%;
            min-height: 100vh;
            background: #FFFFFF;
            overflow-x: hidden;
            /* Add padding to account for fixed header */
            padding-top: 100px;
        }

        .config-form {
            position: relative;
            width: 816px;
            margin: 158px auto;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            /* padding: 40px; */
            /* Add margin bottom to create space above footer */
            margin-bottom: 320px;
        }

        .form-group,
        .form-row {
            /*margin-bottom: 20px; /* Reduced from 40px */
            margin: 76px 0px 0px 60px;
        }

        .form-group label,
        .form-row label {
            display: block;
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
            margin-bottom: 8px; /* Reduced from 16px */
        }

        /* .form-group input {
            width: 89%;
            height: 55px;
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 10px;
            padding: 0 20px;
            font-size: 21.98px;
        } */

        .form-row {
            display: flex;
            gap: 40px;
            margin-top: 10px; /* Added to create better spacing */
        }

        .form-col {
            flex: 1;
        }

        .save-btn {
            width: 327px;
            height: 92px;
            margin: 20px auto;
            display: block;
            background: #D9D9D9;
            border-radius: 50px;
            border: none;
            font-family: 'Inter';
            font-weight: 700;
            font-size: 36px;
            color: #000000;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include '../background.php'; ?>

    <script>
        const editBtn = document.querySelector(".chinh-sua .dropdown-btn");
        editBtn.style.background = "#004787";
        editBtn.style.pointerEvents = "none";
        editBtn.style.cursor = "default";
        const hcmutBtn = document.querySelector(".hcmut-spss");
        hcmutBtn.style.pointerEvents = "auto";
        hcmutBtn.style.cursor = "pointer";
        hcmutBtn.style.background = "transparent";
    </script>

    <form class="config-form">
        <div class="form-group">
            <label>Định dạng tập tin cho phép</label>
            <!-- <input type="text" value="PDF;DOCX;DOC;PNG" placeholder="Nhập định dạng tập tin"> -->
            <input type="text" placeholder="PDF;DOCX;DOC;PNG">
        </div>
        <div class="form-row">
            <div class="form-col">
                <label>Số trang giới hạn mặc định</label>
                <input type="number" value="0" placeholder="Nhập số trang">
            </div>
            <div class="form-col">
                <label>Thời điểm phân phát</label>
                <input type="text" placeholder="DD/MM/YYYY">
            </div>
        </div>
        <button type="submit" class="save-btn">Lưu</button>
    </form>

    <?php include 'footer.php'; ?>
</body>
</html>