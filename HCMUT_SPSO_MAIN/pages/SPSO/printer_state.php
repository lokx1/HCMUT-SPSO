<?php
/* Session checks here */
include '../../js/printer_config.php';

$selectedPrinter = null;
$currentStatus = 'active';

// Handle POST request for status change
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedPrinter = $_POST['printer'];
    $newStatus = $_POST['status'];

    foreach ($printerConfigurations as &$printer) {
        if ($printer['model'] === $selectedPrinter) {
            $printer['status'] = $newStatus;
            $currentStatus = $newStatus;
            break;
        }
    }

    // Save the updated array to the file
    file_put_contents('../../js/printer_config.php', '<?php $printerConfigurations = ' . var_export($printerConfigurations, true) . '; ?>');
    
    // Redirect to GET request with the same printer selected
    header("Location: printer_state.php?printer=" . urlencode($selectedPrinter));
    exit();
}

// Handle GET request for printer selection
if (isset($_GET['printer'])) {
    $selectedPrinter = $_GET['printer'];
    foreach ($printerConfigurations as $printer) {
        if ($printer['model'] === $selectedPrinter) {
            $currentStatus = $printer['status'];
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi trạng thái máy in - SPSO</title>
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

        .printer-state-form {
            position: relative;
            width: 816px;
            height: 736px;
            left: calc(50% - 816px/2);
            top: 132px;
            background: #FFFFFF;
            border: 1px solid #000000;
            box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            margin-bottom: 400px; /* Increase margin to prevent footer overlap */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .printer-image {
            width: 400px;
            height: 400px;
        }

        .printer-select {
            width: 696px;
            gap: 25px;
            margin-top: 40px;
            display: flex;
            align-items: center;
        }

        .printer-select label {
            width: 138px;
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
        }

        .printer-select select {
            width: 540px;
            height: 55px;
        }

        .printer-status {
            width: 696px;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .status-label {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 21.98px;
            color: #000000;
        }

        .status-value {
            font-family: 'Inter';
            font-style: italic;
            font-weight: 400;
            font-size: 21.98px;
            margin-left: 50px;
        }

        .status-active {
            color: #56F000;
        }

        .status-inactive {
            color: #FF3838;
        }

        .state-btn {
            width: 696px;
            height: 92px;
            margin-top: 34px;
            border-radius: 50px;
            border: none;
            font-family: 'Inter';
            font-weight: 700;
            font-size: 36px;
            color: #FFFFFF;
            cursor: pointer;
        }

        .btn-disable {
            background: #FF3838;
        }

        .btn-enable {
            background: #56F000;
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
            min-height: calc(100vh + 600px); /* Increase minimum height to accommodate content */
        }
        .footer {
            position: relative;
            width: 100%;
            margin-top: auto;
            background: #000000;
            min-height: 456px;
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
        <img src="../../css/assets/left-arrow.png" alt="go back arrow">
        <span>Back</span>
    </button>

    <div class="printer-state-form">
        <img src="../../css/assets/printer-state.png" alt="Printer" class="printer-image">
        
        <form method="GET" action="printer_state.php">
            <div class="printer-select">
                <label>Chọn máy in:</label>
                <select id="printerSelect" name="printer" onchange="this.form.submit()">
                    <option value="" disabled <?php echo !$selectedPrinter ? 'selected' : ''; ?>>Chọn máy in...</option>
                    <?php foreach ($printerConfigurations as $printer): ?>
                        <option value="<?php echo htmlspecialchars($printer['model']); ?>" 
                                <?php echo ($printer['model'] === $selectedPrinter) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($printer['model']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <?php if ($selectedPrinter): ?>
        <form method="POST" action="printer_state.php">
            <input type="hidden" name="printer" value="<?php echo htmlspecialchars($selectedPrinter); ?>">
            <div class="printer-status">
                <span class="status-label">Trạng thái:</span>
                <span class="status-value <?php echo ($currentStatus === 'active') ? 'status-active' : 'status-inactive'; ?>">
                    <?php echo ($currentStatus === 'active') ? 'Hoạt động' : 'Tạm dừng'; ?>
                </span>
            </div>

            <input type="hidden" name="status" value="<?php echo ($currentStatus === 'active') ? 'inactive' : 'active'; ?>">
            <button type="submit" class="state-btn <?php echo ($currentStatus === 'active') ? 'btn-disable' : 'btn-enable'; ?>">
                <?php echo ($currentStatus === 'active') ? 'Vô hiệu hóa' : 'Kích hoạt'; ?>
            </button>
        </form>
        <?php endif; ?>
    </div>

    <?php include '../footer.php'; ?>
</body>
</html>