<?php

// Include necessary files
include '../../js/controller.php';
include '../../js/data.php';
include '../../js/printer_config.php';
include '../../js/logAll.php'; // Include the print history
include '../../js/printerSetting.php';

session_start();

// Convert formats string to array and format for accept attribute
$allowedFormats = array_map(function($format) {
    return '.' . strtolower($format);
}, explode(';', $printerSettings['allowed_formats']));
$acceptAttribute = implode(',', $allowedFormats);

// Initialize student session and pages
$student =  getSessionVariables('student');
$pages = $student->pages; // Initialize the global $pages variable
$message = ''; // Initialize message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_FILES['file']) || $_FILES['file']['error'] === UPLOAD_ERR_NO_FILE) {
        $message = 'Vui lòng chọn tệp để in';
    } else {
        $uploadedFileName = $_FILES['file']['name'];
        $copies = intval($_POST['copies']);
        $pagesInput = intval($_POST['pages']);
        $paperSize = $_POST['paper_size'];
        $printSide = $_POST['print_side'];
        $totalPagesNeeded = intval($_POST['total_pages_needed']);
        $printerIndex = intval($_POST['printer']);

        if ($copies <= 0 || $pagesInput <= 0 || empty($paperSize) || empty($printSide)) {
            $message = 'Vui lòng điền đầy đủ thông tin in';
        } else if ($totalPagesNeeded > $pages) {
            $message = 'Không đủ số trang. Vui lòng mua thêm trang.';
        } else {
            $printer = $printerConfigurations[$printerIndex];
            if ($printer['status'] !== 'active') {
                $message = 'Máy in không hoạt động. Vui lòng chọn máy in khác.';
            } else {
                // Process successful print job
                $remainingPages = $pages - $totalPagesNeeded;
                $student->pages = $remainingPages;
                $student->save();

                // Calculate actual number of physical pages for the log
                $actualPages = $copies * $pagesInput;
                if ($printSide === 'Hai mặt' ) {
                    $actualPages = ceil($actualPages / 2);
                }
                if ($paperSize === 'A3') {
                    $actualPages = ceil($actualPages / 2);
                }
                $printHistoryEntry = [
                    'id' => $student->id,
                    'name' => $student->username,
                    'time' => date('H:i:s d/m/Y'),
                    'building' => $printer['building'],
                    'room' => $printer['room'],
                    'total_pages' => "{$actualPages} x {$paperSize}",
                    'msmi' => $printerIndex + 1,
                    'docname' => $uploadedFileName
                ];

                array_unshift($printHistory, $printHistoryEntry);

                // Save updated print history
                $phpCode = "<?php\n\$printHistory = " . var_export($printHistory, true) . ";\n?>";
                file_put_contents('../../js/logAll.php', $phpCode);

                $message = 'In thành công!';
            }
        }
    }
    
    // Return JSON response for AJAX requests
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['message' => $message]);
        exit;
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

    <form method="POST" action="" class="print-form" enctype="multipart/form-data">
        <div class="file-select">
            <div class="file-select-container">


            <input type="file" name="file" id="fileSelector" style="display: none;" accept="<?php echo $acceptAttribute; ?>">
            <button type="button" class="select-btn" onclick="document.getElementById('fileSelector').click();">Chọn tài liệu</button>
            <span class="file-name">Chưa có tài liệu được chọn</span>
            <script>
                document.getElementById('fileSelector').addEventListener('change', function() {
                const fileInput = this;
                const filePath = fileInput.value.toLowerCase();
                const allowedExtensions = new RegExp('(' + <?php echo json_encode($allowedFormats); ?>.join('|').replace(/\./g, '\\.') + ')$', 'i');
                
                if (!allowedExtensions.exec(filePath)) {
                    const allowedFormatsMsg = <?php echo json_encode($printerSettings['allowed_formats']); ?>;
                    document.querySelector('.popup-box .popup-message').textContent = 
                        'Vui lòng chọn tệp có định dạng: ' + allowedFormatsMsg.replace(/;/g, ', ');
                    document.querySelector('.popup-box').classList.add('active');
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
    <select name="printer">
        <option value="" selected disabled hidden>Máy in...</option>
        <?php foreach ($printerConfigurations as $index => $printer): ?>
            <option value="<?php echo $index; ?>">
                <?php echo "{$printer['brand']} {$printer['model']} - {$printer['room']} {$printer['building']}"; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

        <div class="option-row">
            <div class="option-group">
                <label>Số bản</label>
                <input type="number" name="copies" value="0" min="0">
            </div>
            <div class="option-group">
                <label>Kích thước giấy</label>
                <select name="paper_size">
                    <option value="A4">A4</option>
                    <option value="A3">A3</option>
                </select>
            </div>
        </div>

        <div class="option-row">
            <div class="option-group">
                <label>Số trang in</label>
                <input type="number" name="pages" value="0" min="0">
            </div>
            <div class="option-group">
                <label>Trang</label>
                <select name="print_side">
                    <option value="Một mặt">Một mặt</option>
                    <option value="Hai mặt">Hai mặt</option>
                </select>
            </div>
        </div>

        <input type="hidden" name="total_pages_needed" class="total-pages-needed">
        <button type="submit" class="print-btn">In</button>
    </form>
    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <?php include '../footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paperSizeSelect = document.querySelector('select[name="paper_size"]');
            const printSideSelect = document.querySelector('select[name="print_side"]');
            const totalPagesNeededInput = document.querySelector('input[name="total_pages_needed"]');

            function updateTotalPagesNeeded() {
                const copies = parseInt(document.querySelector('input[name="copies"]').value) || 0;
                const pages = parseInt(document.querySelector('input[name="pages"]').value) || 0;
                const paperSize = paperSizeSelect.value;
                const printSide = printSideSelect.value;

                // Calculate total pages for cost
                let totalPagesNeeded = copies * pages;

                // For A3, each page counts as 2 pages for cost calculation
                if (paperSize === 'A3') {
                    totalPagesNeeded *= 2;
                }

                // Apply double-sided printing reduction after A3 calculation
                if (printSide === 'Hai mặt') {
                    totalPagesNeeded = Math.ceil(totalPagesNeeded / 2);
                }

                totalPagesNeededInput.value = totalPagesNeeded;
            }

            // Update the print history entry creation in PHP:
            paperSizeSelect.addEventListener('change', updateTotalPagesNeeded);
            printSideSelect.addEventListener('change', updateTotalPagesNeeded);
            document.querySelector('input[name="copies"]').addEventListener('input', updateTotalPagesNeeded);
            document.querySelector('input[name="pages"]').addEventListener('input', updateTotalPagesNeeded);

            // Initial calculation
            updateTotalPagesNeeded();
        });
    </script>
    <div class="popup-box">
        <div class="popup-message"></div>
        <button class="popup-button" onclick="handlePopupConfirm()">Xác nhận</button>
    </div>
    <script>
function handlePopupConfirm() {
    const popup = document.querySelector('.popup-box');
    const message = popup.querySelector('.popup-message').textContent;
    
    popup.classList.remove('active');
    
    // If it was a success message, refresh the page
    if (message === 'In thành công!') {
        window.location.href = 'print.php';
    }
}

// Replace file selector alert with popup
document.getElementById('fileSelector').addEventListener('change', function() {
    const fileInput = this;
    const filePath = fileInput.value.toLowerCase();
    const allowedExtensions = new RegExp('(' + <?php echo json_encode($allowedFormats); ?>.join('|').replace(/\./g, '\\.') + ')$', 'i');
    
    if (!allowedExtensions.exec(filePath)) {
        const allowedFormatsMsg = <?php echo json_encode($printerSettings['allowed_formats']); ?>;
        document.querySelector('.popup-box .popup-message').textContent = 
            'Vui lòng chọn tệp có định dạng: ' + allowedFormatsMsg.replace(/;/g, ', ');
        document.querySelector('.popup-box').classList.add('active');
        fileInput.value = '';
    } else {
        const fileName = fileInput.files[0].name;
        document.querySelector('.file-name').textContent = fileName;
    }
});

// Show popup if there's a message from PHP
<?php if (!empty($message)): ?>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.popup-box .popup-message').textContent = <?php echo json_encode($message); ?>;
    document.querySelector('.popup-box').classList.add('active');
});
<?php endif; ?>

// Add this JavaScript after your existing scripts
document.querySelector('.print-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('print.php', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const popup = document.querySelector('.popup-box');
        popup.querySelector('.popup-message').textContent = data.message;
        popup.classList.add('active'); // Show popup
        
        if (data.message === 'In thành công!') {
            // Don't auto refresh - let user confirm first
            document.querySelector('.popup-button').onclick = function() {
                window.location.reload();
            };
        } else {
            document.querySelector('.popup-button').onclick = function() {
                popup.classList.remove('active');
            };
        }
    })
    .catch(error => {
        console.error('Error:', error);
        const popup = document.querySelector('.popup-box');
        popup.querySelector('.popup-message').textContent = 'Có lỗi xảy ra';
        popup.classList.add('active');
    });
});

// Modify your handlePopupConfirm function
function handlePopupConfirm() {
    const popup = document.querySelector('.popup-box');
    const message = popup.querySelector('.popup-message').textContent;
    
    popup.classList.remove('active');
    
    if (message === 'In thành công!') {
        window.location.reload();
    }
}

// Add CSS for popup styling
const style = document.createElement('style');
style.textContent = `
    .popup-box {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        padding: 20px;
        background: #fff;
        border: 1px solid #000;
        box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        text-align: center;
    }

    .popup-box.active {
        display: block;
    }

    .popup-message {
        margin-bottom: 20px;
        font-family: 'Inter';
        font-size: 18px;
    }

    .popup-button {
        padding: 10px 20px;
        background: #0F6CBF;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Inter';
    }
`;
document.head.appendChild(style);
</script>
</body>
</html>