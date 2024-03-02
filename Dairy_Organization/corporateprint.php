<?php
include("auth.php");
require('db.php');


if (isset($_GET['corporateno'])) {
    $corporateno = mysqli_real_escape_string($con, $_GET['corporateno']);

    
    $sel_query = "SELECT c.*, ch.date as ch_date, ch.fat_content as ch_fat_content, ch.quantity as ch_quantity, ch.profit_percentage as ch_profit_percentage, ch.final_price
    FROM corporate c
    LEFT JOIN corporatechecking ch ON c.name = ch.name AND c.date = ch.date
    WHERE c.corporateno = '$corporateno' AND c.date = CURDATE()
    LIMIT 1;";

    $result = mysqli_query($con, $sel_query);

    if (!$result) {
        die("Error in search query: " . mysqli_error($con));
    }
} else {
    
    header("Location: corporate.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
          body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center; 
    align-items: center;
}

.receipt {
    width: 700px; 
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}


        .company-details {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .company-details img {
            max-width: 100px;
            margin-right: 20px; 
        }

        .company-details p {
            margin: 0;
        }

        .title {
            font-weight: bold;
            background-color: lightseagreen; 
            padding: 10px; 
            color: black; 
            width: 100%; 
            display: block; 
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .receipt-details {
            text-align: left;
        }

        .receipt-details label {
            display: inline-block;
            width: 150px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .receipt-data {
            color: #555;
        }

        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        h1 {
            font-size: 1.5em;
            color: lightseagreen;
            background-color: lightseagreen ;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

       
        .title p {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 0 5px 15px;
        }

        .tabletitle {
            padding: 5px;
            font-size: .5em;
            background: #EEE;
        }

    </style>
</head>
<body>
<div class="receipt">
        <div class="company-details">
            <img src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png">
            <h1 class="title">NatureOne Dairy Management </h1>
        </div>
        <h2 class="title">Payment Receipt</h2>
        <div class="receipt-details">
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                ?>
                <tr>
                    <td><label>Name:</label></td>
                    <td class="receipt-data"><?php echo $row["name"]; ?></td>
                </tr>
                <br>
                <tr>
                    <td><label>Address:</label></td>
                    <td class="receipt-data"><?php echo $row["address"]; ?></td>
                </tr>
                <br>
                <tr>
                    <td><label>Date:</label></td>
                    <td class="receipt-data"><?php echo $row["ch_date"]; ?></td>
                </tr>
                <br>
                <tr>
                    <td><label>Phone Number:</label></td>
                    <td class="receipt-data"><?php echo $row["phoneno"]; ?></td>
                </tr>
                <br>
                <tr>
                    <td><label>Quantity of Milk:</label></td>
                    <td class="receipt-data"><?php echo $row["ch_quantity"]; ?> liters</td>
                </tr>
                <br>
                <tr>
                    <td><label>Price:</label></td>
                    <td class="receipt-data"><?php echo $row["final_price"]; ?></td>
                </tr>
            <?php } ?>
        </div>
        <button onclick="window.print()">Print</button>
    </div>
</body>
</html>
