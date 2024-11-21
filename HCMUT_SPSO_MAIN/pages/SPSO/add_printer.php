<?php
/* Session checks here */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm máy in - SPSO</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/background.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/SPSO.css">
    <style>
        .back-to-home {
            width: 123px;
            height: 57px;
        }

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

        .add-printer-form {
            position: relative;
            width: 816px;
            height: fit-content;
            /* height: 1118px; */
            margin: 132px auto 0px;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            /* padding: 40px; */
        }

        .form-group{
            margin-bottom: 40px;
            display: flex;
            gap: 25px;
            margin-left: 60px;
        }

        .form-row {
            display: flex;
            /* justify-content: space-between; */
            /* margin: 57px 30px 0 30px; */
            /* gap: 40px;   */
            margin-top: 42px;
            gap: 18px;
        }

        .form-row .form-group {
            display: flex;
            flex-direction: column;
            width: 318px;
            margin: 0;
            padding: 0;
        }

        .form-row .form-group label {
            /* position: relative; */
            /* margin-bottom: 16px; */
        }

        .form-row .form-group .dropdown-list {
            width: 318px;
            height: 55px;
        }

        .placement, 
        .description {
            flex-direction: column;
        }

        .location-container {
            box-sizing: border-box;
            position: relative;
            width: 714px;
            height: 266px;
            /* margin: 38px auto; */
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 30px;
            /* padding: 20px; */
        }

        .location-container .form-group:first-child {
            /* width: 654px;
            height: 55px;
            margin: 18px auto; */
            margin-left: 30px;
            /* margin-top: 38px; */
            /* margin-bottom: 0px; */
            
        }

        .location-container .form-group {
            /* margin-bottom: 20px; */
            /* margin-left: 30px; */
            margin-top: 38px;
            /* margin-bottom: 42px; */
        }

        .location-container .form-row .form-group {
            margin-top: -12px;
        }

        /* .dropdown-list {
            box-sizing: border-box;
            width: 100%;
            height: 55px;
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 10px;
            padding: 16px;
            font-size: 21.98px;
        } */

        .campus-dropdown {
            width: 548px;
            height: 55px;
            /* height: 110px; */
        }

        .add-btn {
            position: relative;
            width: 327px;
            height: 92px;
            margin: 40px auto;
            display: block;
            background: #FFBF00;
            border-radius: 50px;
            border: none;
            font-family: 'Inter';
            font-weight: 700;
            font-size: 36px;
            color: #000000;
            cursor: pointer;
        }
/* 
        .footer {
            margin-top: auto;
        } */

        .brand {
            margin-top: 76px;
        }
        
        .form-group label {
            display: block;
            transform: translateY(25%);
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            /* line-height: 100%; */
            color: #000000;
            /* margin-bottom: 16px; */
        }

        .brand input {
            width: 354px;
        }

        .model input {
            width: 505px;
        }
 
        .form-group textarea {
            width: 100%;
            max-width: 682px; /* Prevent touching edges */
            height: 220px;
            resize: none;
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 10px;
            /* padding: 16px; */
            padding: 16px 0px 0px 21px;
            font-size: 21.98px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

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

    <div class="decoration decoration-top"></div>
    <div class="decoration decoration-bottom"></div>

    <button onclick="window.location.href='printer_info.php'" class="back-to-home">
        <!-- <span>←</span> -->
        <img src="../../css/assets/left-arrow.png" alt="go back arrow">
        <span>Back</span>
    </button>

    <form class="add-printer-form">
        <div class="form-group brand">
            <label>Thương hiệu/nhà sản xuất:</label>
            <input type="text" placeholder="Epson">
        </div>

        <div class="form-group model">
            <label>Mẫu máy in:</label>
            <input type="text" placeholder="WorkForce Pro WF-3730">
        </div>

        <div class="form-group placement">
            <label>Vị trí lắp đặt máy in:</label>
            <div class="location-container">
                <div class="form-group">
                    <label>Trường:</label>
                    <select class="dropdown-list campus-dropdown">
                        <option>Trường Đại học Bách khoa cơ sở 1</option>
                        <option>Trường Đại học Bách khoa cơ sở 2</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Tòa nhà:</label>
                        <select class="dropdown-list">
                            <option>A1</option>
                            <option>A2</option>
                            <option>A3</option>
                            <option>A4</option>
                            <!-- other options -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phòng:</label>
                        <select class="dropdown-list">
                            <option>101</option>
                            <option>102</option>
                            <option>103</option>
                            <option>104</option>
                            <!-- other options -->
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group description">
            <label>Mô tả:</label>
            <textarea placeholder="Đây là máy in."></textarea>
        </div>

        <button type="submit" class="add-btn">Thêm máy in</button>
    </form>

    <?php include '../footer.php'; ?>
</body>
</html>