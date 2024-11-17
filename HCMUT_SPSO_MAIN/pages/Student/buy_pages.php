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
            min-height: calc(100vh + 1200px); /* Increase page height */
        }

        .paper-options {
            position: relative;
            width: 1223px;
            height: 723px;
            left: 108px;
            top: 210px;
            margin-bottom: 400px; /* Increase margin to push footer down */
        }

        .paper-card {
            position: absolute;
            width: 428px;
            height: 723px;
            background: rgba(0, 0, 0, 0.8);
            transition: background 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #FFFFFF;
            padding-bottom: 40px; /* Add padding to fit button */
        }

        .paper-card:hover {
            background: rgba(0, 0, 0, 0.9);
        }

        .paper-a4 {
            left: 462px; /* Align with right side of info sidebar */
        }

        .paper-a3 {
            left: 903px;
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
            margin-top: 57px;
        }

        .price, .total {
            font-weight: 700;
            font-size: 36px;
            line-height: 44px;
            margin-top: 87px;
        }

        .total {
            margin-top: 117px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 33px;
        }

        .quantity-btn {
            width: 31.15px;
            height: 26.98px;
            background: #FFFFFF;
            border: none;
            cursor: pointer;
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
            margin-top: 42px;
            border: none;
            border-radius: 4px;
            font-weight: 700;
            font-size: 36px;
            color: #FFFFFF;
            cursor: pointer;
            position: absolute; /* Position button absolutely */
            bottom: 40px; /* Move up from bottom */
        }

        .paper-a4 .buy-btn {
            background: #0F6CBF;
        }

        .paper-a3 .buy-btn {
            background: #FFBF00;
        }

        .divider {
            width: 867px;
            height: 0px;
            border: 2px solid #FFFFFF;
            position: absolute;
            left: 462px;
        }

        .divider-top {
            top: 655px;
        }

        .divider-bottom {
            top: 736px;
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
            top: 185px;
        }

        .decoration-bottom {
            left: -160px;
            top: 648px;
        }

        .back-to-home {
            position: absolute;
            width: 224px;
            height: 57px;
            left: 37px;
            top: 153px;
            background: #FFFFFF;
            border: 1px solid #000000;
            border-radius: 30px;
            font-family: 'Inter';
            font-weight: 400;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px;
            cursor: pointer;
        }

        .info-sidebar {
            position: absolute;
            width: 354px;
            height: 380px;
            left: 25px; /* Updated position */
            top: 286px; /* Updated position */
            background: #FFFFFF;
            border: 2px solid #000000;
            box-shadow: 0px 4px 50px 5px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            padding: 40px;
        }

        .info-divider {
            width: 100%;
            height: 0;
            border: 2px solid #000000;
            margin: 30px 0;
        }

        .info-label {
            position: relative;
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            font-size: 36px;
            line-height: 44px;
            color: #000000;
            margin-bottom: 20px;
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

    <div class="decoration decoration-top"></div>
    <div class="decoration decoration-bottom"></div>

    <button onclick="window.location.href='home.php'" class="back-to-home">
        <span>←</span>
        <span>Back to home</span>
    </button>

    <div class="paper-options">
        <div class="info-sidebar">
            <div class="info-label">Giá:</div>
            <div class="info-divider"></div>
            <div class="info-label">Số trang:</div>
            <div class="info-divider"></div>
            <div class="info-label">Tổng:</div>
        </div>
        
        <div class="paper-card paper-a4">
            <h2 class="paper-size">A4</h2>
            <img src="../../assets/shopping-cart-white.png" alt="Cart" class="cart-icon">
            <p class="price">Giá: 1.000 VND</p>
            <div class="quantity-control">
                <button class="quantity-btn">-</button>
                <div class="quantity-display">4</div>
                <button class="quantity-btn">+</button>
            </div>
            <p class="total">Tổng: 4.000 VND</p>
            <button class="buy-btn">Mua</button>
        </div>

        <div class="paper-card paper-a3">
            <h2 class="paper-size">A3</h2>
            <img src="../../assets/shopping-cart-white.png" alt="Cart" class="cart-icon">
            <p class="price">Giá: 2.000 VND</p>
            <div class="quantity-control">
                <button class="quantity-btn">-</button>
                <div class="quantity-display">4</div>
                <button class="quantity-btn">+</button>
            </div>
            <p class="total">Tổng: 8.000 VND</p>
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