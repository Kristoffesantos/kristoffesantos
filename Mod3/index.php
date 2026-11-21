<?php
declare(strict_types = 1);

// Product data: [Product Name => ['price' => float, 'stock' => int]]
$donuts = [
    'Glazed Donut' => ['price' => 20.00, 'stock' => 15],
    'Chocolate Donut' => ['price' => 25.00, 'stock' => 12],
    'Strawberry Donut' => ['price' => 25.00, 'stock' => 8],
    'Vanilla Donut' => ['price' => 25.00, 'stock' => 20],
    'Boston Cream Donut' => ['price' => 30.00, 'stock' => 7],
    'Cookies and Cream Donut' => ['price' => 30.00, 'stock' => 18],
];

$tax = 20; // Tax rate percentage

function get_reorder_message(int $stock): string
{
    return ($stock < 10) ? 'Yes' : 'No';
}

function get_total_value(float $price, int $quantity): float
{
    return $price * $quantity;
}

function get_tax_due(float $price, int $quantity, int $tax = 0): float
{
    return ($price * $quantity) * ($tax / 100);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glazer Donut - Stock Control</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <h1>Glazer Donut</h1>
    <h2>Stock Control</h2>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Stock</th>
                    <th>Re-order</th>
                    <th>Total Value</th>
                    <th>Tax Due</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($donuts as $product_name => $data) { ?>
                    <tr>
                        <td><?= htmlspecialchars($product_name) ?></td>
                        <td><?= $data['stock'] ?></td>
                        <td><?= get_reorder_message($data['stock']) ?></td>
                        <td>₱<?= number_format(get_total_value($data['price'], $data['stock']), 2) ?></td>
                        <td>₱<?= number_format(get_tax_due($data['price'], $data['stock'], $tax), 2) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>Glazer Donut &copy; 2026</p>
    </footer>

</body>
</html>
