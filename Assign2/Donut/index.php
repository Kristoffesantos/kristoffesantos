//Glazer Donut System

<?php include 'header.php'; ?>

<h2>Donut Order Form</h2>

<form action="process.php" method="POST">

    <label>Customer Name:</label>
    <input type="text" name="customer_name" required>

    <label>Customer Type:</label>
    <select name="customer_type">
        <option value="student">Student</option>
        <option value="employee">Employee</option>
        <option value="guest">Guest</option>
    </select>

    <label>Donut Type:</label>
    <select name="donut">
        <option value="D1">Chocolate Donut</option>
        <option value="D2">Glazed Donut</option>
        <option value="D3">Strawberry Donut</option>
    </select>

    <label>Quantity:</label>
    <input type="number" name="quantity" min="1" max="10" required>

    <label>Budget:</label>
    <input type="number" name="budget" min="0" required>

    <label>Payment Method:</label>
    <select name="payment">
        <option value="Cash">Cash</option>
        <option value="gcash">GCash</option>
    </select>

    <button type="submit">Place Order</button>

</form>

<?php include 'footer.php'; ?>
