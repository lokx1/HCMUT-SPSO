<?php
/* Session checks here */

// Include settings file or create default settings
$settingsFile = '../../js/printer_settings.php';

if (file_exists($settingsFile)) {
    include $settingsFile;
} else {
    $printerSettings = array(
        'allowed_formats' => 'PDF;DOCX;DOC;PNG',
        'page_limit' => 0,
        'distribution_date' => ''
    );
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $printerSettings = array(
        'allowed_formats' => $_POST['formats'],
        'page_limit' => intval($_POST['page_limit']),
        'distribution_date' => $_POST['distribution_date']
    );

    // Save settings to file
    $settingsContent = '<?php $printerSettings = ' . var_export($printerSettings, true) . '; ?>';
    file_put_contents($settingsFile, $settingsContent);
}
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
            height: 548px;
            /* margin: 158px auto; */
            margin: 158px auto 0px;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            /* padding: 40px; */
            /* Add margin bottom to create space above footer */
            /* margin-bottom: 320px; */
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
            margin-bottom: 16px; /* Reduced from 16px */
        }

        .form-group input {
            width: 656px;
            height: 55px;
            /* background: #FFFFFF;
            border: 1px solid #D9D9D9;
            border-radius: 10px;
            padding: 0 20px;
            font-size: 21.98px; */
        }

        .form-row {
            display: flex;
            gap: 60px;
            margin-top: 42px; /* Added to create better spacing */
        }

        /* .form-col {
            flex: 1;
        } */

        .form-col input {
            width: 278px;
        }

        .save-btn {
            position: absolute;
            bottom: 76px;
            left: 245px;
            width: 327px;
            height: 92px;
            /* margin: 20px auto; */
            /* margin: 152px auto; */
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

    <form class="config-form" method="POST">
        <div class="form-group">
            <label>Định dạng tập tin cho phép</label>
            <input type="text" name="formats" 
                   value="<?php echo htmlspecialchars($printerSettings['allowed_formats']); ?>"
                   placeholder="PDF;DOCX;DOC;PNG">
        </div>
        <div class="form-row">
            <div class="form-col">
                <label>Số trang giới hạn mặc định</label>
                <input type="number" name="page_limit"
                       value="<?php echo htmlspecialchars($printerSettings['page_limit']); ?>"
                       placeholder="0">
            </div>
            <div class="form-col">
                <label>Thời điểm phân phát</label>
                <input type="text" name="distribution_date"
                       value="<?php echo htmlspecialchars($printerSettings['distribution_date']); ?>"
                       placeholder="DD/MM/YYYY">
            </div>
        </div>
        <button type="submit" class="save-btn">Lưu</button>
    </form>

    <?php include '../footer.php'; ?>

    <script>
        // Add date picker functionality
        const dateInput = document.querySelector('input[name="distribution_date"]');
        dateInput.addEventListener('input', function(e) {
            let value = e.target.value;
            value = value.replace(/\D/g, '');
            if (value.length >= 8) {
                const day = value.substr(0,2);
                const month = value.substr(2,2);
                const year = value.substr(4,4);
                value = `${day}/${month}/${year}`;
            }
            e.target.value = value;
        });

        // Enable save button when form is changed
        const form = document.querySelector('.config-form');
        const saveBtn = document.querySelector('.save-btn');
        
        form.addEventListener('input', function() {
            saveBtn.style.background = '#FFBF00';
        });
    </script>
</body>
</html>