<?php
include("auth.php");
require('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Combined Records</title>
    <style>
     body {
    font: 16px/1.3 "Serif", sans-serif;
    
    background: linear-gradient(to bottom, #d8a1ff, #ff6161, #feda75);
    
    margin: 0;
}

.container {
    margin: 10px;
}

.form {
    margin-top: 90px;
}

h2 {
    text-align: center;
    color: white;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    background: #2ecc71; 
}

th, td {
    border: 1px solid #fff;
    text-align: center;
    color: #fff;
    font-size: 16px; 
    font-weight: 600; 
    padding: 18px;
}

th {
    background-color: #333;
}

td {
    background-color: #555;
}

tr:hover td {
    background-color: gray;
    color: black; 
}

a {
    color: #fff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.header {
    position: fixed;
    right: 0;
    top: 0;
    width: 100%;
    background: black; 
    color: white;
    text-align: center;
    padding: 1px; 
}

.list {
    float: right;
    margin-right: 40px;
}

.list li {
    display: inline-block;
    margin-right: 30px;
    margin-top: 10px; 
}

.list li a {
    text-decoration: none;
    font-size: 20px;
    color: white;
    font-family: serif;
    font-weight: bold;
}

.list li:hover {
    border-bottom: 4px solid yellow;
    transition: .3s;
}
#logo {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 120px; 
            height: auto; 
        }

    </style>
</head>
<body>
    <div class="header">
        <ul class="list">
        <img id="logo" src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="Logo">
        <li><a href="Homepage.php">Home</a></li>
            <li><a href="dashboard.php"> Dashboard</a></li>
        </ul>
    </div>
    <div class="container">
        <?php
        $sel_query = "SELECT DISTINCT date FROM farmers ORDER BY date DESC;";
        $date_result = mysqli_query($con, $sel_query);

        if (!$date_result) {
            die("Error in date query: " . mysqli_error($con));
        }

        while ($date_row = mysqli_fetch_assoc($date_result)) {
            $current_date = $date_row['date'];
            ?>
            <div class="form">
                <h2>Combined Records - <?php echo $current_date; ?></h2>
                <table>
                    <thead>
                        <tr>
                            <th>Total Milk</th>
                            <th>Milk Price</th>
                            <th>Sales Milk</th>
                            <th>Sales Price</th>
                            <th>Balance Milk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;

                        
                        $sel_query_farmers = "SELECT SUM(q.quantityofmilk) AS farmers_quantity, SUM(qc.price) AS farmers_price
                            FROM farmers AS f
                            LEFT JOIN quantityfarmers AS q ON f.farmers_no = q.farmers_no AND f.date = q.date
                            LEFT JOIN quantitychecking AS qc ON f.farmers_no = qc.farmers_no AND f.date = qc.date
                            WHERE f.date = '$current_date';";

                        $result_farmers = mysqli_query($con, $sel_query_farmers);

                        if (!$result_farmers) {
                            die("Error in farmers records query: " . mysqli_error($con));
                        }

                        
                        $sel_query_corporate = "SELECT SUM(ch.quantity) AS corporate_quantity, SUM(ch.final_price) AS corporate_final_price
                            FROM corporate c
                            LEFT JOIN corporatechecking ch ON c.name = ch.name AND c.date = ch.date
                            WHERE c.date = '$current_date';";

                        $result_corporate = mysqli_query($con, $sel_query_corporate);

                        if (!$result_corporate) {
                            die("Error in corporate records query: " . mysqli_error($con));
                        }

                        $row_farmers = mysqli_fetch_assoc($result_farmers);
                        $row_corporate = mysqli_fetch_assoc($result_corporate);

                       
                        $quantity_difference = isset($row_farmers["farmers_quantity"]) ? $row_farmers["farmers_quantity"] : 0;
                        $quantity_difference -= isset($row_corporate["corporate_quantity"]) ? $row_corporate["corporate_quantity"] : 0;
                        ?>
                        <tr>
                           
                            <td align="center"><?php echo isset($row_farmers["farmers_quantity"]) ? number_format($row_farmers["farmers_quantity"], 2) : 0; ?></td>
                            <td align="center"><?php echo isset($row_farmers["farmers_price"]) ? number_format($row_farmers["farmers_price"], 2) : 0; ?></td>
                           
                            <td align="center"><?php echo isset($row_corporate["corporate_quantity"]) ? number_format($row_corporate["corporate_quantity"], 2) : 0; ?></td>
                            <td align="center"><?php echo isset($row_corporate["corporate_final_price"]) ? number_format($row_corporate["corporate_final_price"], 2) : 0; ?></td>
                            
                            <td align="center"><?php echo number_format($quantity_difference, 2); ?></
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
        }
        ?>
    </div>
</body>
</html>

