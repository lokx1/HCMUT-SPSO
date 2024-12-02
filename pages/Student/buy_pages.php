<?php
/* Session checks here */
include '../../js/controller.php';
include '../../js/data.php';
session_start();
$student =  getSessionVariables('student');
$pages = $student->pages;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $size = $_POST['size'];
    $quantity = intval($_POST['quantity']);

    // Update remaining pages based on paper size
    $remainingPages = $student->pages;

    if ($size == 'A3') {
        $remainingPages += 2 * $quantity;
    } else if ($size == 'A4') {
        $remainingPages += $quantity;
    }

    $student->pages = $remainingPages;
    $student->save();

    // Update session variable if necessary
    $_SESSION['remaining_pages'] = $remainingPages;

    // Redirect to refresh the page and update the header
    header("Location: buy_pages.php");
    exit();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mua trang - Student</title>
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
            min-height: 100vh; */
            /* background: #FFFFFF; */
            /* overflow-x: hidden; */
            padding-top: 100px;
            /* display: flex; */
            /* flex-direction: column; */
            /*min-height: calc(100vh + 1200px); /* Increase page height */
        }

        .paper-options {
            position: relative;
            width: 1223px;
            height: 723px;
            left: calc(50% - 1223px/2);
            /* left: 108px; */
            top: 110px;
            margin-bottom: 200px; /* Increase margin to push footer down */
        }

        .paper-card {
            position: absolute;
            width: 428px;
            height: 100%;
            /* transition: background 0.3s ease;     */
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #FFFFFF;
            /*padding-bottom: 41px; /* Add padding to fit button */
        }

        /* .paper-card:hover {
            background: rgba(0, 0, 0, 0.9);
        } */

        .paper-a4 {
            background: rgba(0, 0, 0, 0.8);
            right: 441px; /* Align with right side of info sidebar */
        }

        .paper-a3 {
            background: rgba(0, 0, 0, 0.6);
            right: 0px;
        }

        .paper-size {
            font-weight: 700;
            font-size: 64px;
            line-height: 77px;
            margin-top: 39px;
        }

        .cart-icon {
            width: 150px;
            height: 150px;
            margin-top: 30px;
        }

        .price, .total {
            font-weight: 700;
            font-size: 36px;
            line-height: 44px;
            margin-top: 87px;
        }

        .total {
            margin-top: 47px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10.5px;
            margin-top: 9.5px;
        }

        .quantity-btn {
            /* width: 31.11px;
            height: 31.11px; */
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .left {
            border-top: 15.5px solid transparent;
            border-right: 31.11px solid #FFFFFF;
            border-bottom: 15.5px solid transparent;
        }

        .right {
            border-top: 15.5px solid transparent;
            border-left: 31.11px solid #FFFFFF;
            border-bottom: 15.5px solid transparent;
        }

        .quantity-display {
            width: 31.11px;
            height: 31.11px;
            background: #FFFFFF;
            border-radius: 9.78px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 21.36px;
            color: #000000;
        }

        .buy-btn {
            width: 175px;
            height: 53px;
            /* margin-top: 42px; */
            border: none;
            border-radius: 4px;
            font-weight: 700;
            font-size: 36px;
            color: #FFFFFF;
            cursor: pointer;
            position: relative; /* Position button relative */
            top: -3.5px;
        }

        .paper-a4 .buy-btn {
            background: #0F6CBF;
        }

        .paper-a3 .buy-btn {
            background: #FFBF00;
        }

        .divider {
            box-sizing: border-box;
            width: 869px;
            position: absolute;
            right: 0px;
            height: 0px;
            border: 2px solid #FFFFFF;
            /* left: 462px; */
        }

        .divider-top {
            top: 446px;
        }

        .divider-bottom {
            top: 530px;
        }

        .info-sidebar {
            box-sizing: border-box;
            position: absolute;
            width: 100%;
            height: 380px;
            /*left: 25px; /* Updated position */
            bottom: 0px; /* Updated position */
            background: #FFFFFF;
            border: 2px solid #000000;
            box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            /* padding: 40px; */
        }

        .info-divider {
            box-sizing: border-box;
            width: 374px;
            height: 0;
            border: 2px solid #000000;
            margin: 18px 0px 18px 0px;
        }

        .info-label {
            position: relative;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-size: 36px;
            line-height: 44px;
            color: #000000;
            margin-left: 76px;
        }

        .info-label:first-child {
            margin: 40px 0px 0px 76px;
        }

        .price-label {
            top: 40px;
        }

        .pages-label {
            top: 121px;
        }

        .total-label {
            top: 201px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include '..\background.php'; ?>
    <!-- Navigation bar editing script -->
    <script>
        const printBtn = document.querySelector(".nav-buttons .nav-btn-purchase");
        printBtn.style.background = "#004787";
        printBtn.style.pointerEvents = "none";
        printBtn.style.cursor = "default";
        const hcmutBtn = document.querySelector(".hcmut-spss");
        hcmutBtn.style.pointerEvents = "auto";
        hcmutBtn.style.cursor = "pointer";
        hcmutBtn.style.background = "transparent";
    </script>
    <div class="paper-options">
        <div class="info-sidebar">
            <div class="info-label">Giá:</div>
            <div class="info-divider"></div>
            <div class="info-label">Số trang:</div>
            <div class="info-divider"></div>
            <div class="info-label">Tổng:</div>
        </div>
        
        <?php foreach ($papers as $paper): ?>
        <div class="paper-card paper-<?php echo strtolower($paper->size); ?>" data-price="<?php echo $paper->pricePerPage; ?>">
            <span class="paper-size"><?php echo $paper->size; ?></span>
            <img src="../../css/assets/shopping-cart-white.png" alt="Cart" class="cart-icon">
            <p class="price"><?php echo number_format($paper->pricePerPage, 0, ',', '.'); ?> VND</p>
            <div class="quantity-control">
                <button type="button" class="quantity-btn left"></button>
                <div class="quantity-display"><?php echo $paper->quantity; ?></div>
                <button type="button" class="quantity-btn right"></button>
            </div>
            <p class="total"><?php echo number_format($paper->totalPrice, 0, ',', '.'); ?> VND</p>
            <form action="buy_pages.php" method="post">
                <input type="hidden" name="size" value="<?php echo $paper->size; ?>">
                <input type="hidden" name="quantity" value="<?php echo $paper->quantity; ?>" class="quantity-input">
                <input type="hidden" name="total_price" value="<?php echo $paper->totalPrice; ?>" class="total-input">
                <button type="submit" class="buy-btn">Mua</button>
            </form>
        </div>
        <?php endforeach; ?>

        <div class="divider divider-top"></div>
        <div class="divider divider-bottom"></div>
    </div>

    <?php include '../footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paperCards = document.querySelectorAll('.paper-card');

            paperCards.forEach(card => {
                const pricePerPage = parseInt(card.getAttribute('data-price'));
                const quantityDisplay = card.querySelector('.quantity-display');
                const totalDisplay = card.querySelector('.total');
                const minusButton = card.querySelector('.quantity-btn.left');
                const plusButton = card.querySelector('.quantity-btn.right');
                const quantityInput = card.querySelector('.quantity-input');
                const totalInput = card.querySelector('.total-input');

                minusButton.addEventListener('click', () => {
                    let quantity = parseInt(quantityDisplay.textContent);
                    if (quantity > 1) {
                        quantity--;
                        updateDisplay(quantity);
                    }
                });

                plusButton.addEventListener('click', () => {
                    let quantity = parseInt(quantityDisplay.textContent);
                    quantity++;
                    updateDisplay(quantity);
                });

                function updateDisplay(quantity) {
                    quantityDisplay.textContent = quantity;
                    const totalPrice = pricePerPage * quantity;
                    totalDisplay.textContent = `${totalPrice.toLocaleString()} VND`;
                    quantityInput.value = quantity;
                    totalInput.value = totalPrice;
                }
            });
        });
    </script>
</body>
</html>