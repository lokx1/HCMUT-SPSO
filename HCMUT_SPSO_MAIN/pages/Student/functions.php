<?php
function getRemainingPages() {
    $file = 'remaining_pages.txt';
    if (file_exists($file)) {
        return intval(file_get_contents($file));
    }
    return 0;
}

function setRemainingPages($pages) {
    $file = 'remaining_pages.txt';
    file_put_contents($file, $pages);
}

function storePrintJob($copies, $pages, $printer) {
    $remainingPages = getRemainingPages();
    $totalPagesNeeded = $copies * $pages;

    if ($totalPagesNeeded > $remainingPages) {
        return false; // Not enough pages
    }

    // Decrease the remaining pages
    $remainingPages -= $totalPagesNeeded;
    setRemainingPages($remainingPages);

    // Debug statement
    error_log("Remaining pages after print job: $remainingPages");

    // Store the print job details (optional, for logging purposes)
    $file = 'print_jobs.txt';
    $printJob = "Printer: $printer, Copies: $copies, Pages: $pages, Total Pages: $totalPagesNeeded\n";
    file_put_contents($file, $printJob);

    return true;
}

?>