<?php
include("auth.php");
require('db.php');


$corporate_no = isset($_GET['corporate']) ? $_GET['corporate'] : "";
$month = isset($_GET['month']) ? $_GET['month'] : "";
$year = isset($_GET['year']) ? $_GET['year'] : "";


if (empty($corporate_no) || empty($month) || empty($year)) {
    echo "Invalid parameters!";
    exit;
}


$query = "SELECT c.*, ch.date as ch_date, ch.fat_content as ch_fat_content, ch.quantity as ch_quantity, ch.profit_percentage as ch_profit_percentage, ch.price as ch_price, ch.final_price
FROM corporate c
LEFT JOIN corporatechecking ch ON c.name = ch.name AND c.date = ch.date
          WHERE c.corporateno = '$corporate_no' AND MONTH(c.date) = $month AND YEAR(c.date) = $year";

$result = mysqli_query($con, $query);

if (!$result) {
    die("Error in query: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Corporate Details</title>
    
    <style>
        body {
            font: 16px/1.3 "Serif", sans-serif;
            background: #123;
        }

        .container {
            margin: 10px;
        }

        .form {
            margin-top: 90px;
        }

        h1 {
            color: white;
            text-align: center;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            border: 1px solid #fff;
            text-align: center;
            color: #fff;
            border: 0px solid #ddd;
            font-size: 16px;
            font-weight: 600;
        }

        th {
            background-color: #333;
            padding: 18px;
        }

        td {
            background-color: #555;
            padding: 18px;
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
            background-color: black;
            color: white;
            text-align: center;
            padding: px;
           
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

      
        .month-section {
            margin-top: 30px;
            border-top: 2px solid #fff;
            padding-top: 20px;
        }
            .header {
        position: fixed;
        right: 0;
        top: 0;
        width: 100%;
        background-color: black;
        color: white;
        text-align: center;
        padding: px; 
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
    .header-below-table {
            text-align: center;
            margin-top: 80px;
            font-size: 18px;
            color: black;
        }
    </style>
    
</head>

<body>
<div class="header">
    <ul class="list">
    <img id="logo" src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="Logo">
    <li><a href="Homepage.php">Home</a></li>
        <li><a href="dashboard.php"> Dashboard</a></li>
        <li><a href="corporateview.php">Corporate Records</a></li>
        <li><a href="corporatetotalquantity.php">Total Collection</a></li>
        <li><a href="corporatemonth.php">Monthly Collection</a></li>
    </ul>
  </div>
  <div class="header-below-table">
  <h1>Corporate Details - <?php echo $corporate_no; ?></h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Corporate No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Date</th>
                <th>Phone Number</th>
                <th>Fat Content</th>
                <th>Quantity of Milk</th>
                <th>Profit Percentage</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1; 
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td align="center"><?php echo $count; ?></td>
                    <td align="center"><?php echo $row["corporateno"]; ?></td>
                    <td align="center"><?php echo $row["name"]; ?></td>
                    <td align="center"><?php echo $row["address"]; ?></td>
                    <td align="center"><?php echo $row["ch_date"]; ?></td>
                    <td align="center"><?php echo $row["phoneno"]; ?></td>
                    <td align="center"><?php echo $row["ch_fat_content"]; ?></td>
                    <td align="center"><?php echo $row["ch_quantity"]; ?></td>
                    <td align="center"><?php echo $row["ch_profit_percentage"]; ?></td>
                    <td align="center"><?php echo number_format($row["final_price"], 2); ?></td>
                </tr>
            <?php
                $count++; 
            }
            ?>
        </tbody>
    </table>
</body>

</html>
