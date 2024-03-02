<?php
include("auth.php");
require('db.php');


$search_result = null;


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['search'])) {

    $searchFarmersNo = mysqli_real_escape_string($con, $_POST['farmers_no']);

   
    $sel_query = "SELECT f.*, C.Category AS C_Category, C.date as C_date, q.quantityofmilk AS q_quantityofmilk, q.date as q_date, qc.fat_content as qc_fat_content, qc.date as qc_date, qc.price
    FROM farmers AS f
    LEFT JOIN cowsinfo AS C ON f.farmers_no = C.farmers_no AND f.date = C.date
    LEFT JOIN quantityfarmers AS q ON f.farmers_no = q.farmers_no AND f.date = q.date
    LEFT JOIN quantitychecking AS qc ON f.farmers_no = qc.farmers_no AND f.date = qc.date
    WHERE f.farmers_no = '$searchFarmersNo'
    LIMIT 1;";

    
    $search_result = mysqli_query($con, $sel_query);
    if (!$search_result) {
        die("Query failed: " . mysqli_error($con));
    }
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
            $count = 1;
            $farmers_no = $_REQUEST['farmers_no'];

            $sel_query = "SELECT f.farmers_no, f.name, f.address, f.date as f_date, f.phoneno, C.Category AS C_Category, C.date as C_date, q.quantityofmilk AS q_quantityofmilk, q.date as q_date, qc.fat_content as qc_fat_content, qc.date as qc_date, qc.price
            FROM farmers AS f
            LEFT JOIN cowsinfo AS C ON f.farmers_no = C.farmers_no AND f.date = C.date
            LEFT JOIN quantityfarmers AS q ON f.farmers_no = q.farmers_no AND f.date = q.date
            LEFT JOIN quantitychecking AS qc ON f.farmers_no = qc.farmers_no AND f.date = qc.date
            WHERE f.farmers_no = $farmers_no
            AND f.date = CURRENT_DATE()
            LIMIT 1;"; 

            $result = mysqli_query($con, $sel_query);

            if ($result && $row = mysqli_fetch_assoc($result)) {
                ?>
                <label>Name:</label>
                <span class="receipt-data"><?php echo isset($row["name"]) ? $row["name"] : ''; ?></span><br>
                <label>Address:</label>
                <span class="receipt-data"><?php echo isset($row["address"]) ? $row["address"] : ''; ?></span><br>
                <label>Date:</label>
                <span class="receipt-data"><?php echo
isset($row["qc_date"]) ? $row["qc_date"] : ''; ?></span><br>
                <label>Phone Number:</label>
                <span class="receipt-data"><?php echo isset($row["phoneno"]) ? $row["phoneno"] : ''; ?></span><br>
                <label>Quantity of Milk:</label>
                <span class="receipt-data"><?php echo isset($row["q_quantityofmilk"]) ? $row["q_quantityofmilk"] . ' liters' : ''; ?></span><br>
                <label>Price:</label>
                <span class="receipt-data"><?php echo isset($row["price"]) ? $row["price"] : ''; ?></span><br>
            <?php } else {
                 echo "Error fetching data or no records found.";
             } ?>
        </div>
        <button onclick="window.print()">Print</button>
    </div>
</body>
</html>
