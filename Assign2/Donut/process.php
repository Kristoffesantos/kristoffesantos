<?php
//1. INCLUDE: Load donut menu
include 'menu.php';

//2. Customer Details
$name = trim($_POST['customer_name'] ?? '');
$type = $_POST['customer_type'] ?? '';
$donut = $_POST['donut'] ?? '';
$quantity = filter_var($_POST['quantity'] ?? null, FILTER_VALIDATE_INT);
$budget = filter_var($_POST['budget'] ?? null, FILTER_VALIDATE_FLOAT);
$payment = $_POST['payment'] ?? '';

//3. MATCH: Determine Donut Price
$item = match ($donut) {
    "D1" => ["Chocolate Donut", 35],
    "D2" => ["Glazed Donut", 30],
    "D3" => ["Strawberry Donut", 40],
    default => ["Unknown Donut", 0]
};

[$donutName, $price] = $item;

//4. Calculate Subtotal
$subtotal = $price * $quantity;

//5. IF-ELSE-IF: Customer Discount
if ($type == "student") {
    $discountRate = 0.10;
} elseif ($type == "employee") {
    $discountRate = 0.05;
} else {
    $discountRate = 0;
}

$discount = $subtotal * $discountRate;
$total = $subtotal - $discount;

//6. SWITCH: Determine Payment Method
switch ($payment) {
    case "Cash":
        $paymentLabel = "Cash Payment";
        break;
    case "gcash":
        $paymentLabel = "GCash Payment";
        break;
    default:
        $paymentLabel = "Unknown Payment Method";
}

//7. Display Transaction
include 'header.php';

echo "<h2>Donut Ordering System</h2>";
echo "<p>Customer: $name</p>";
echo "<p>Customer Type: $type</p>";
echo "<p>Donut: $donutName</p>";
echo "<p>Quantity: $quantity</p>";

//8. FOR-LOOP: Display Donut Breakdown
echo "<h3>Donut Breakdown</h3>";

for ($i = 1; $i <= $quantity; $i++) {
    echo "Donut $i: P" . number_format($price, 2) . "<br>";
}

//9. WHILE LOOP: Preparation Status
echo "<h3>Preparation Status</h3>";

$counter = 1;
while ($counter <= $quantity) {
    echo "Preparing donut $counter of $quantity<br>";
    $counter++;
}

//10. Display Bill
echo "<hr>";

echo "<p>Subtotal: P " . number_format($subtotal, 2) . "</p>";
echo "<p>Discount: P " . number_format($discount, 2) . "</p>";
echo "<h2>Total Bill: P " . number_format($total, 2) . "</h2>";

echo "<p>Budget: P " . number_format($budget, 2) . "</p>";
echo "<p>Payment Method: $paymentLabel</p>";

//11. IF-ELSE: Check Budget
if ($budget >= $total) {
    $change = $budget - $total;
    echo "<p>Payment Successful!</p>";
    echo "<p>Change: P " . number_format($change, 2) . "</p>";
} else {
    $shortage = $total - $budget;
    echo "<p>Insufficient Budget!</p>";
    echo "<p>Additional Payment Needed: P " . number_format($shortage, 2) . "</p>";
}

echo '<p><a href="index.php">Place Another Order</a></p>';

include 'footer.php';
?>