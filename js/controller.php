<?php




class Paper {
    public $size;
    public $pricePerPage;
    public $quantity;
    public $totalPrice;
    public $printerName;
    public $date;

    public function __construct($size, $pricePerPage, $quantity = 1, $printerName = 'Default Printer') {
        $this->size = $size;
        $this->pricePerPage = $pricePerPage;
        $this->quantity = $quantity;
        $this->printerName = $printerName;
        $this->date = date('Y-m-d H:i:s');
        $this->updateTotalPrice();
    }

    public function updateTotalPrice() {
        $this->totalPrice = $this->pricePerPage * $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        $this->updateTotalPrice();
    }
}

$papers = [
    new Paper('A4', 1000),
    new Paper('A3', 2000)
];
class Student {
    public $id;
    public $pages;
    public $username;
    public $password;
    public $printHistory;

    public function __construct($id, $username, $password, $pages = 0) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->pages = $pages;
        $this->printHistory = [];
    }



    public function addPrintHistory($print) {
        $this->printHistory[] = $print;
        $this->addToSystemHistory($print);
    }

    private function addToSystemHistory($print) {
        $systemHistoryFile = 'system_print_history.txt';
        $data = json_encode([
            'student_id' => $this->id,
            'username' => $this->username,
            'size' => $print->paper->size,
            'quantity' => $print->paper->quantity,
            'total_price' => $print->paper->totalPrice,
            'printer' => $print->paper->printerName,
            'date' => $print->date
        ]) . PHP_EOL;
        file_put_contents($systemHistoryFile, $data, FILE_APPEND);
    }
    public function resetPages() {
        setRemainingPages(0);
        $this->pages = 0;
        $this->save();
    }

    public function save() {
        // Implement saving student data to storage (e.g., database or file)
        $_SESSION['student_pages'] = $this->pages;


    }



}

// Initialize a student with 10 pages if not already set

function getRemainingPages() {
    global $pages;
    return $pages;
}

function setRemainingPages($pages) {
    $_SESSION['remaining_pages'] = $pages;
}
function resetRemainingPages() {
    setRemainingPages(0);
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