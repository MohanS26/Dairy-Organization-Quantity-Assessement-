<?php
include("auth.php");
require('db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Farmers Records</title>
    <style>
        body {
            margin: 0;
            font-family: 'Lato', sans-serif;
            background-color: #e6f7ff;
        }

        .container {
            margin: 10px;
        }

        .form {
            margin-top: 90px;
        }

        h1 {
            color: black;
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
            background: linear-gradient(to bottom, #3498db, #2980b9);
            font-size: 16px;
            font-weight: 600;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            color: white;
        }

        td {
            color: black;
        }

        thead {
            background-color: #34495e;
            color: white;
        }

        tbody {
            background-color: #ecf0f1;
        }

        tbody tr:hover {
            background-color: lightgrey;
            color: lightblue;
        }

        a {
            text-decoration: none;
            color: #007bff;
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
        
.view-details-btn {
    background-color: blueviolet; 
    color: white; 
    padding: 10px 15px; 
    border: none; 
    border-radius: 5px; 
    cursor: pointer; 
    font-size: 16px; 
    transition: background-color 0.3s;
}

.view-details-btn:hover {
    background-color:red ; 
}

    </style>
</head>
<body>
    <div class="header">
        <ul class="list">
            <img id="logo" src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="Logo">
            <li><a href="Homepage.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="farmersview1.php">Farmers Records</a></li>
            <li><a href="farmerstotalquantity.php">Total Collection</a></li>
            <li><a href="farmersmonth.php">Monthly  Collection</a></li>  
        </ul>
    </div>

    <div class="container">
        <?php
        $sel_query_farmers = "SELECT DISTINCT farmers_no FROM farmers ORDER BY farmers_no;";
        $farmers_result = mysqli_query($con, $sel_query_farmers);

        if (!$farmers_result) {
            die("Error in farmers query: " . mysqli_error($con));
        }

        while ($farmers_row = mysqli_fetch_assoc($farmers_result)) {
            $current_farmers = $farmers_row['farmers_no'];
        ?>
            <div class="month-section">
                <h1>Total Monthly Collection - Farmers No: <?php echo $current_farmers; ?></h1>
                <?php
                $sel_query_months = "SELECT DISTINCT MONTH(date) as month, YEAR(date) as year FROM farmers WHERE farmers_no='$current_farmers' ORDER BY year DESC, month DESC;";
                $months_result = mysqli_query($con, $sel_query_months);

                if (!$months_result) {
                    die("Error in months query: " . mysqli_error($con));
                }

                while ($month_row = mysqli_fetch_assoc($months_result)) {
                    $current_month = $month_row['month'];
                    $current_year = $month_row['year'];

                   
                    $total_query = "SELECT 
                                        farmers_no,
                                        name,
                                        SUM(qc.quantityofmilk) as total_quantity,
                                        SUM(qc.price) as total_price
                                    FROM quantitychecking qc
                                    WHERE qc.farmers_no='$current_farmers' AND MONTH(qc.date) = $current_month AND YEAR(qc.date) = $current_year";

                    $total_result = mysqli_query($con, $total_query);

                    if (!$total_result) {
                        die("Error in total query: " . mysqli_error($con));
                    }

                    $total_row = mysqli_fetch_assoc($total_result);
                ?>
                    <h2><?php echo date("F Y", strtotime($current_year . "-" . $current_month . "-01")); ?></h2>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Farmers No</th>
                                <th>Name</th>
                                <th>Total Quantity of Milk</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"><?php echo $total_row["farmers_no"]; ?></td>
                                <td align="center"><?php echo $total_row["name"]; ?></td>
                                <td align="center"><?php echo $total_row["total_quantity"]; ?></td>
                                <td align="center"><?php echo number_format($total_row["total_price"], 2); ?></td>
                                <td align="center">
                                    <button onclick="window.location.href='farmersviewdetails.php?farmers_no=<?php echo $current_farmers; ?>&month=<?php echo $current_month; ?>&year=<?php echo $current_year; ?>'" class="view-details-btn">View Details</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>
</body>
</html>