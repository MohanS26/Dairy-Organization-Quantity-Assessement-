<?php


include("auth.php");
require('db.php');

if (isset($_GET['farmers_no'])) {
    $farmers_no = mysqli_real_escape_string($con, $_GET['farmers_no']);

    $sel_query = "SELECT f.name, f.farmers_no, f.address, f.date, f.phoneno, C.Category AS C_Category, q.quantityofmilk AS qc_quantity, qc.fat_content as qc_fat_content, qc.price
        FROM farmers AS f
        LEFT JOIN cowsinfo AS C ON f.farmers_no = C.farmers_no
        LEFT JOIN quantityfarmers AS q ON f.farmers_no = q.farmers_no
        LEFT JOIN quantitychecking AS qc ON f.farmers_no = qc.farmers_no
        WHERE f.farmers_no = '$farmers_no'
        LIMIT 1;";  

    $result = mysqli_query($con, $sel_query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        
    </style>
</head>
<body>

<div class="header">
    <ul class="list">
        <li><a href="Homepage.php">Home</a></li>
        <li><a href="dashboard.php">Organization Dashboard</a></li>
        <li><a href="farmersview1.php">Farmers Record</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="receipt">
    <h2>Payment Receipt</h2>

    
    <?php if (isset($result) && mysqli_num_rows($result) > 0): ?>
        <div class="receipt-details">
            <?php
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) { ?>
               
                <label>Name:</label>
                <span class="receipt-data"><td><?php echo $row["name"]; ?></td></span>
                <br>
                <label>Address:</label>
                <td><?php echo $row["address"]; ?></td>
                <label>Date:</label>
                <td><?php echo $row["date"]; ?></td>
                <br>
                <label>Phone Number:</label>
                <td><?php echo $row["phoneno"]; ?></td>
                <br>
                <label>Quantity of Milk:</label>
                <td><?php echo $row["qc_quantity"]; ?> liters</td>
                <br>
                <label>Price:</label>
                <td><?php echo $row["price"]; ?></td>
            <?php } ?>
        </div>
       
        <button onclick="window.print()">Print</button>
    <?php endif; ?>
</div>

</body>
</html>
