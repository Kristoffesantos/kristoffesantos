<? php
if ($_SERVER['REQUEST_METHOD' ] !== 'POST') {
    header('Location: index.php');
    exit;
}
$name = trim($_POST['customer_name'] ?? '');
$type = $_POST['customer_type' ] ?? '';
$product = $_POST['product'] ?? '';
$quantity = filter_var($_POST['quantity'] ?? null,
    FILTER_VALIDATE_INT);
$budget = filter_var($_POST['budget' ] ?? nu1l,
    FILTER_VALIDATE_FLOAT);

Svalid = $name !== '*
    && in_array($type, ['student', "employee', 'guest' ], true)
    && in_array($product, ["M1', 'M2', 'M3', "D1' ,'D2' ], true)
    && Squantity !== false && $quantity !== null
    && Squantity >= 1 && $quantity <= 10
    && Sbudget !== false && $budget !== null
    && $budget >= 0 && is_finite($budget);
    if (!$valid) {
    include 'header.php';
    echo '<p class="error">Invalid order. Please check your input. </p>';
    echo '<a href="index.php">Return to formc/a>';
    include 'footer.php';
    exit;
}

$item = match ($product) {
    "M1' => ['Chicken Adobo Meal', 85, true],
    "M2' => ['Pork Sisig Meal', 100, true],
    "M3' => ['Vegetable Meal', 70, true],
    "D1' => ['Bottled Water", 20, false],
    "D2' => ['Iced Tea', 35, false]
};
[$productName, $price, $isFood] = $item;
$subtotal = $price * $quantity;
if ($isFood && $type === 'student') {
    $rate = .10;
} elseif ($isFood && $type === 'employee' ) {
    $rate = .05;
} else {
    $rate = 0;
}
$discount = $subtotal * $rate;
$total = $subtotal - $discount;

include 'header.php';
echo '<h2>Order Receipt</h2>';
echo '<p>Customer: ' . htmlspecialchars($name, ENT_QUOTES, "UTF-8') . '</p>';
echo '<p>Customer type: ' . htmlspecialchars(ucfirst($type)) . '</p>';
echo '<h3>Items Ordered</h3>';
for ($1 = 1; $1 <= $quantity; $i++) {
    echo '<p>' . $1 . '. ' . htmlspecialchars($productName) .
        ' - PHP ' . number_format($price, 2) . '</p>';

echo '<p>Subtotal: PHP ' . number_format($subtotal, 2) . '</p>';
echo '<p>Discount: PHP ' . number_format($discount, 2) . "</p>';
echo '<h2>Final Bill: PHP ' . number_format($total, 2) . "</h2>';
echo '<p>Budget: PHP ' . number_format ($budget, 2) . '</p>';
if ($budget >= $total) {
    echo '<p class="success">Budget is sufficient !< /p>';
    echo '<p>Balance: PHP ' . number_format($budget - $total, 2) . '</p>';
} else {
    echo '<p class="error">Insufficient budget !< /p>';
    echo '<p>Shortage: PHP ' . nunber_format($total - $budget, 2) . '</p>';
}
echo '<h3>Preparation Progress</h3>";
$counter = 1;
while ($counter <= $quantity) {
    echo '<p>Preparing item ' . $counter . ' of ' . $quantity . '</p>';
    $counter++;
}
echo '<p><a href="index.php">Place another order</a></p>';
include 'footer.php';
?>