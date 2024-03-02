<?php
include("auth.php");
require('db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Monthly Corporate Records</title>
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
        .view-details-btn {
    background-color: darkblue; 
    color: white; 
    padding: 10px 15px; 
    border: none; 
    border-radius: 5px; 
    cursor: pointer; 
    font-size: 16px; 
    transition: background-color 0.3s; 
}

.view-details-btn:hover {
    background-color:lightseagreen ; 
}
    </style>
    <link rel="stylesheet" href="css/style.css" />
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
    <div class="container">
        <?php
        $sel_query_corporates = "SELECT DISTINCT corporateno FROM corporate ORDER BY corporateno;";
        $corporates_result = mysqli_query($con, $sel_query_corporates);

        if (!$corporates_result) {
            die("Error in corporates query: " . mysqli_error($con));
        }

        while ($corporate_row = mysqli_fetch_assoc($corporates_result)) {
            $current_corporate = $corporate_row['corporateno'];
        ?>
            <div class="month-section">
                <h1>Total Monthly Collection - <?php echo $current_corporate; ?></h1>
                <?php
                $sel_query_months = "SELECT DISTINCT MONTH(date) as month, YEAR(date) as year FROM corporate WHERE corporateno='$current_corporate' ORDER BY year DESC, month DESC;";
                $months_result = mysqli_query($con, $sel_query_months);

                if (!$months_result) {
                    die("Error in months query: " . mysqli_error($con));
                }

                while ($month_row = mysqli_fetch_assoc($months_result)) {
                    $current_month = $month_row['month'];
                    $current_year = $month_row['year'];

                    
                    $total_query = "SELECT 
                                        SUM(ch.final_price) as total_price,
                                        SUM(ch.quantity) as total_quantity
                                    FROM corporate c
                                    LEFT JOIN corporatechecking ch ON c.name = ch.name AND c.date = ch.date
                                    WHERE c.corporateno='$current_corporate' AND MONTH(c.date) = $current_month AND YEAR(c.date) = $current_year";

                    $total_result = mysqli_query($con, $total_query);

                    if (!$total_result) {
                        die("Error in total query: " . mysqli_error($con));
                    }

                    $total_row = mysqli_fetch_assoc($total_result);
                ?>
                    <h2><?php echo date("F Y", strtotime($current_year . "-" . $current_month . "-01")); ?></h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Corporate No</th>
                                <th>Quantity of Milk</th>
                                <th>Total Collection</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $name_corporate_query = "SELECT 
                                                        c.name as name, 
                                                        c.corporateno as corporateno
                                                    FROM corporate c
                                                    WHERE c.corporateno='$current_corporate' AND MONTH(c.date) = $current_month AND YEAR(c.date) = $current_year
                                                    GROUP BY c.name, c.corporateno";

                            $name_corporate_result = mysqli_query($con, $name_corporate_query);

                            if (!$name_corporate_result) {
                                die("Error in name and corporate query: " . mysqli_error($con));
                            }

                            while ($name_corporate_row = mysqli_fetch_assoc($name_corporate_result)) {
                            ?>
                                <tr>
                                    <td align="center"><?php echo $name_corporate_row["name"]; ?></td>
                                    <td align="center"><?php echo $name_corporate_row["corporateno"]; ?></td>
                                    <td align="center"><?php echo $total_row["total_quantity"]; ?></td>
                                    <td align="center"><?php echo number_format($total_row["total_price"], 2); ?></td>
                                    
<td align="center">
    <button onclick="window.location.href='corporateviewdetails.php?corporate=<?php echo $current_corporate; ?>&month=<?php echo $current_month; ?>&year=<?php echo $current_year; ?>'" class="view-details-btn">View Details</button>
</td>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
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
