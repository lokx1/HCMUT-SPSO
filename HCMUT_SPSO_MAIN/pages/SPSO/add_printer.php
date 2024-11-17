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

        .add-printer-form {
            position: relative;
            width: 816px;
            height: fit-content;
            margin: 232px auto 200px;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            padding: 40px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            margin: 57px 30px 0 30px;
            gap: 40px;
        }

        .form-row .form-group {
            width: 318px;
            margin: 0;
            padding: 0;
        }

        .form-row .form-group label {
            position: relative;
            margin-bottom: 16px;
        }

        .form-row .form-group .dropdown-list {
            width: 318px;
            height: 55px;
        }

        .form-group {
            margin-bottom: 40px;
        }

        .location-container {
            box-sizing: border-box;
            position: relative;
            width: 714px;
            height: 266px;
            margin: 38px auto;
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 30px;
            padding: 20px;
        }

        .location-container .form-group:first-child {
            width: 654px;
            height: 55px;
            margin: 18px auto;
        }

        .location-container .form-group {
            margin-bottom: 20px;
        }

        .dropdown-list {
            box-sizing: border-box;
            width: 100%;
            height: 55px;
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 10px;
            padding: 16px;
            font-size: 21.98px;
        }

        .campus-dropdown {
            width: 548px;
            height: 110px;
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

        .footer {
            margin-top: auto;
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

        .form-group label {
            display: block;
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            line-height: 100%;
            color: #000000;
            margin-bottom: 16px;
        }

        .form-group input, 
        .form-group select, 
        .form-group textarea {
            width: 100%;
            max-width: 714px; /* Prevent touching edges */
            background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 10px;
            padding: 16px;
            font-size: 21.98px;
        }

        .form-group textarea {
            height: 220px;
            resize: none;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="decoration decoration-top"></div>
    <div class="decoration decoration-bottom"></div>
    
    <button onclick="window.location.href='printer_info.php'" class="back-to-home">
        <span>←</span>
        <span>Back</span>
    </button>

    <form class="add-printer-form">
        <div class="form-group">
            <label>Thương hiệu/nhà sản xuất:</label>
            <input type="text" placeholder="Epson">
        </div>

        <div class="form-group">
            <label>Mẫu máy in:</label>
            <input type="text" placeholder="WorkForce Pro WF-3730">
        </div>

        <div class="form-group">
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

        <div class="form-group">
            <label>Mô tả:</label>
            <textarea placeholder="Đây là máy in."></textarea>
        </div>

        <button type="submit" class="add-btn">Thêm máy in</button>
    </form>

    <?php include 'footer.php'; ?>
</body>
</html>