<?php
// At the beginning of header.php
global $pages;
?>

<nav class="header">
    <a href="home.php" class="hcmut-spss">
        <div class="logo"></div>
        <div class="hcmut-title">HCMUT_SPSS</div>
    </a>
    
    <div class="nav-buttons">
        <a href="print.php" class="nav-btn-print">In</a>
        <a href="buy_pages.php" class="nav-btn-purchase">Mua trang</a>
        <a href="print_history.php" class="nav-btn-history">Lịch sử in</a>
    </div>

    <div class="page-count">
        <div class="count-box">
        <span>Trang còn lại: <?php echo $pages; ?></span>
            <img src="../../css/assets/availablePaper.png" alt="Paper Icon">
        </div>
    </div>

    <div class="user-info">
        <span class="username"><?php echo htmlspecialchars($student->username); ?></span>
        <a href="../../index.php">
            <img src="../../css/assets/Default_pfp.svg" alt="Profile" class="profile-pic">
        </a>
    </div>
</nav>