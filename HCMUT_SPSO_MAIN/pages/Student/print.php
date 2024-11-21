<?php
/* Session checks here */
session_start();
include '../../js/controller.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure all form fields have 'name' attributes
    $copies = intval($_POST['copies']);
    $pages = intval($_POST['pages']);
    $printer = $_POST['printer'];
    $paperSize = $_POST['paper_size'];
    $quantity = intval($_POST['quantity']);

    // Validate inputs
    if ($copies <= 0 || $pages <= 0 || $printer == '0' || empty($paperSize)) {
        $message = "Please enter valid values for all fields.";
    } else {
        if (storePrintJob($copies, $pages, $printer)) {
            $message = "Print job stored successfully!";
            $remainingPages = getRemainingPages(); // Update remaining pages
        } else {
            $message = "Not enough pages. Please buy more pages.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In tài liệu - Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/background.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/student.css">
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
            min-height: calc(100vh + 800px);
        }

        .print-form {
            position: relative;
            width: 816px;
            height: 736px;
            left: calc(50% - 816px/2);
            top: 132px;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            margin-bottom: 200px; /* Increase margin to prevent footer overlap */
        }

        .file-select {
            width: 696px;
            height: 61px;
            margin: 42px auto;
        }

        .file-select-container {
            width: 100%;
            height: 100%;
            background: #0F6CBF;
            border-radius: 50px;
            display: flex;
            align-items: center;
        }

        .select-btn {
            width: 203.65px;
            height: 38.72px;
            margin-left: 14px;
            background: #FFFFFF;
            border-radius: 50px;
            border: none;
            font-family: 'Inter';
            font-size: 24.2541px;
            cursor: pointer;
        }

        .file-name {
            margin-left: 21px;
            color: #FFFFFF;
            font-family: 'Inter';
            font-size: 24.2541px;
        }

        .form-row {
            width: 696px;
            margin: 49px auto;
            display: flex;
            align-items: center;
        }

        .form-row label {
            width: 130.66px;
            font-family: 'Inter';
            font-size: 21.98px;
            color: #000000;
        }

        .form-row select {
            position: relative;
            width: 540px;
            height: 55px;
            margin-left: 26px;

        }

        .option-row {
            display: flex;
            gap: 60px;
            width: 696px;
            margin: 40px auto;
        }

        .option-group {
            width: 318px;
        }

        .option-group label {
            display: block;
            font-family: 'Inter';
            font-size: 21.98px;
            color: #000000;
            margin-bottom: 16px;
        }


        .option-group select {
            width: 100%;
            height: 55px;
            /* background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 10px;
            padding: 0 20px;
            font-size: 21.98px; */
        }

        .print-btn {
            width: 327px;
            height: 92px;
            margin: 76px auto;
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
    </style>
    </head>
<body>
    <?php include 'header.php'; ?>
    <?php include '../background.php'; ?>
    <script>
        const printBtn = document.querySelector(".nav-buttons .nav-btn-print");
        printBtn.style.background = "#004787";
        printBtn.style.pointerEvents = "none";
        printBtn.style.cursor = "default";
        const hcmutBtn = document.querySelector(".hcmut-spss");
        hcmutBtn.style.pointerEvents = "auto";
        hcmutBtn.style.cursor = "pointer";
        hcmutBtn.style.background = "transparent";
    </script>

    <form class="print-form">
        <div class="file-select">
            <div class="file-select-container">


            <input type="file" id="fileSelector" style="display: none;" accept=".pdf">
            <button type="button" class="select-btn" onclick="document.getElementById('fileSelector').click();">Chọn tài liệu</button>
            <span class="file-name">Chưa có tài liệu được chọn</span>
            <script>
                document.getElementById('fileSelector').addEventListener('change', function() {
                const fileInput = this;
                const filePath = fileInput.value;
                const allowedExtensions = /(\.pdf)$/i;
                if (!allowedExtensions.exec(filePath)) {
                    alert('Vui lòng chọn tệp PDF.');
                    fileInput.value = '';
                } else {
                    const fileName = fileInput.files[0].name;
                    document.querySelector('.file-name').textContent = fileName;
                }
                });
            </script>
            </div>
        </div>

        <div class="form-row">
            <label>Chọn máy in</label>
            <select>
                <option value="0" selected disabled hidden>Máy in...</option>
                <option value="1">Máy in tòa nhà A1-302</option>
                <option value="2">Máy in tòa nhà A2-209</option>
                <option value="3">Máy in tòa nhà A3-208</option>
                <option value="4">Máy in tòa nhà A4-101</option>
                <option value="5">Máy in tòa nhà A5-212</option>
                <option value="6">Máy in tòa nhà B1-410</option>
            </select>
        </div>

        <div class="option-row">
            <div class="option-group">
                <label>Số bản</label>
                <input type="number" value="0" min="0">
            </div>
            <div class="option-group">
                <label>Kích thước giấy</label>
                <select>
                    <option>A4</option>
                    <option>A3</option>
                </select>
            </div>
        </div>

        <div class="option-row">
            <div class="option-group">
                <label>Số trang in</label>
                <input type="number" value="0" min="0">
            </div>
            <div class="option-group">
                <label>Trang</label>
                <select>
                    <option>Một mặt</option>
                    <option>Hai mặt</option>
                </select>
            </div>
        </div>

        <button type="submit" class="print-btn">In</button>
    </form>
    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <?php include '../footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityControls = document.querySelectorAll('.quantity-control');

            quantityControls.forEach(control => {
                const display = control.querySelector('.quantity-display');
                const minusButton = control.querySelector('.quantity-btn.left');
                const plusButton = control.querySelector('.quantity-btn.right');
                let quantity = parseInt(display.textContent);

                minusButton.addEventListener('click', () => {
                    if (quantity > 1) {
                        quantity--;
                        updateDisplay(quantity);
                    }
                });

                plusButton.addEventListener('click', () => {
                    quantity++;
                    updateDisplay(quantity);
                });

                function updateDisplay(quantity) {
                    display.textContent = quantity;
                }
            });
        });
    </script>
    <?php include '../footer.php'; ?>
</body>
</html>