<?php
/* Session checks here */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin máy in - SPSO</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/SPSO.css">
    <style>
        .back-to-home {
            box-sizing: border-box;
            position: absolute;
            width: 224px;
            height: 57px;
            left: 37px;
            top: 153px;
            background: #FFFFFF;
            border: 1px solid #000000;
            border-radius: 30px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
            color: #000000;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px;
        }

        .printer-buttons {
            display: flex;
            justify-content: center;
            gap: 100px;
            margin-top: 243px;
            /* Add margin bottom to create space above footer */
            margin-bottom: 320px;
        }

        .printer-card {
            box-sizing: border-box;
            position: relative;
            width: 473px;
            height: 439px;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 40px;
        }

        .add-printer {
            background: #FFBF00;
        }

        .edit-printer {
            background: #0F6CBF;
        }

        .printer-card img {
            width: 256px;
            height: 256px;
            margin-top: 39px;
        }

        .printer-card h2 {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-size: 52px;
            line-height: 63px;
            color: #000000;
            margin-top: 38px;
        }

        .edit-printer h2 {
            color: #FFEBEB;
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
            right: -160px; /* Makes only half of the circle visible */
            top: 185px;
        }

        .decoration-bottom {
            left: -160px; /* Makes only half of the circle visible */
            top: 648px;
        }

        /* Add notification modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 861px;
        }

        .modal-content {
            background: #FFFFFF;
            padding: 40px;
            position: relative;
            border-radius: 30px;
            box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
        }

        .modal-title {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-size: 96px;
            line-height: 116px;
            color: #000000;
            margin-bottom: 20px;
            text-align: center;
        }

        .modal-text {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 32px;
            line-height: 39px;
            text-align: center;
            color: #000000;
            margin-bottom: 40px;
        }

        .modal-divider {
            width: 600px;
            height: 0px;
            border: 1px solid #000000;
            margin: 40px auto;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 201px;
            margin-top: 40px;
        }

        .modal-btn {
            width: 330px;
            height: 70.5px;
            border: 0.75px solid #000000;
            border-radius: 37.5px;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-size: 27px;
            line-height: 33px;
            cursor: pointer;
        }

        .state-btn {
            background: #FFFFFF;
            color: #000000;
        }

        .add-btn {
            background: #032B91;
            color: #FFFFFF;
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

    <div class="printer-buttons">
        <div class="printer-card add-printer">
            <img src="../../assets/plus-black-symbol.png" alt="Add Printer">
            <h2>Thêm máy in</h2>
        </div>
        <div class="printer-card edit-printer">
            <img src="../../assets/setting.png" alt="Edit Printer">
            <h2>Chỉnh sửa máy in</h2>
        </div>
    </div>

    <!-- Add modal HTML -->
    <div id="printerModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-title">Máy in</h2>
            <p class="modal-text">Bạn có thể vô hiệu hóa máy in nếu máy in gặp trục trặc, hoặc kích hoạt trở lại sau khi đã khắc phục. Khi có máy in mới được cài đặt, hãy thêm máy in vào hệ thống để đưa máy in vào sử dụng.</p>
            <div class="modal-divider"></div>
            <div class="modal-buttons">
                <button class="modal-btn state-btn">Thay đổi trạng thái</button>
                <button class="modal-btn add-btn">Thêm</button>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Add JavaScript to handle modal -->
    <script>
    document.querySelector('.add-printer').addEventListener('click', function() {
        document.getElementById('printerModal').style.display = 'block';
    });

    document.querySelector('.edit-printer').addEventListener('click', function() {
        document.getElementById('printerModal').style.display = 'block';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('printerModal')) {
            document.getElementById('printerModal').style.display = 'none';
        }
    });

    document.querySelector('.modal-buttons .add-btn').addEventListener('click', function() {
        window.location.href = 'add_printer.php';
    });

    document.querySelector('.modal-btn.state-btn').addEventListener('click', function() {
        window.location.href = 'printer_state.php';
    });
    </script>
</body>
</html>