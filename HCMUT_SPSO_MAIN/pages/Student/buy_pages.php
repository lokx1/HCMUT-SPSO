<?php
/* Session checks here */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mua trang - Student</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
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
            background: rgba(0, 0, 0, 0.8);
            transition: background 0.3s ease;
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
            position: absolute; /* Position button absolutely */
            bottom: 41px; /* Move up from bottom */
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
    <?php include 'background.php'; ?>
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
        
        <div class="paper-card paper-a4">
            <span class="paper-size">A4</span>
            <img src="../../css/assets/shopping-cart-white.png" alt="Cart" class="cart-icon">
            <p class="price">1.000 VND</p>
            <div class="quantity-control">
                <button class="quantity-btn left"></button>
                <div class="quantity-display">4</div>
                <button class="quantity-btn right"></button>
            </div>
            <p class="total">4.000 VND</p>
            <button class="buy-btn">Mua</button>
        </div>

        <div class="paper-card paper-a3">
            <span class="paper-size">A3</span>
            <img src="../../css/assets/shopping-cart-white.png" alt="Cart" class="cart-icon">
            <p class="price">2.000 VND</p>
            <div class="quantity-control">
                <button class="quantity-btn left"></button>
                <div class="quantity-display">4</div>
                <button class="quantity-btn right"></button>
            </div>
            <p class="total">8.000 VND</p>
            <button class="buy-btn">Mua</button>
        </div>

        <div class="divider divider-top"></div>
        <div class="divider divider-bottom"></div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        // Add quantity control functionality
        const quantityControls = document.querySelectorAll('.quantity-control');
        quantityControls.forEach(control => {
            const display = control.querySelector('.quantity-display');
            const [decBtn, incBtn] = control.querySelectorAll('.quantity-btn');
            let quantity = 4;

            decBtn.onclick = () => {
                if (quantity > 0) {
                    quantity--;
                    display.textContent = quantity;
                    updateTotal(control.closest('.paper-card'), quantity);
                }
            };

            incBtn.onclick = () => {
                quantity++;
                display.textContent = quantity;
                updateTotal(control.closest('.paper-card'), quantity);
            };
        });

        function updateTotal(card, quantity) {
            const price = card.classList.contains('paper-a4') ? 1000 : 2000;
            const total = price * quantity;
            card.querySelector('.total').textContent = `Tổng: ${total.toLocaleString()} VND`;
        }
    </script>
</body>
</html>