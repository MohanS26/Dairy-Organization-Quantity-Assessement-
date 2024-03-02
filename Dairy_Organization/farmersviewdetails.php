<?php
include("auth.php");
require('db.php');


$farmers_no = isset($_GET['farmers_no']) ? $_GET['farmers_no'] : '';
$month = isset($_GET['month']) ? $_GET['month'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

if (empty($farmers_no) || empty($month) || empty($year)) {
    echo "Invalid parameters!";
    exit;
}


$query = "SELECT 
            f.farmers_id,
            f.farmers_no,
            f.name,
            f.address,
            f.date AS qc_date,
            f.phoneno,
            C.Category AS C_Category,
            q.quantityofmilk AS q_quantityofmilk,
            qc.fat_content AS qc_fat_content,
            
            qc.price
        FROM farmers AS f
        LEFT JOIN cowsinfo AS C ON f.farmers_no = C.farmers_no AND f.date = C.date
        LEFT JOIN quantityfarmers AS q ON f.farmers_no = q.farmers_no AND f.date = q.date
        LEFT JOIN quantitychecking AS qc ON f.farmers_no = qc.farmers_no AND f.date = qc.date
        WHERE f.farmers_no = '$farmers_no' AND MONTH(f.date) = $month AND YEAR(f.date) = $year
        ORDER BY f.farmers_id DESC";

$result = mysqli_query($con, $query);

if (!$result) {
    die("Error in query: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Farmers Details</title>
    <style>
body {
    margin: 0;
    font-family: 'Lato', sans-serif;
    
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


body {
    margin: 0;
    font-family: 'Lato', sans-serif;
    background-color: #e6f7ff; 
}




th, td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
    color: white;
}
td{
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
    color:lightblue; 
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
        <li><a href="farmersview.php">Farmers Records</a></li>
        <li><a href="farmerstotalquantity.php">Total  Collection</a></li>  
        <li><a href="farmersmonth.php">Month  Collection</a></li>  
    </ul>
</div>
<div class="header-below-table">
<h1>Farmers Details - <?php echo $farmers_no; ?></h1>

    <table border="1">
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
                <th>Fat Content</th>
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
                    <td align="center"><?php echo $row["farmers_no"]; ?></td>
                    <td align="center"><?php echo $row["name"]; ?></td>
                    <td align="center"><?php echo $row["address"]; ?></td>
                    <td align="center"><?php echo $row["qc_date"]; ?></td>
                    <td align="center"><?php echo $row["phoneno"]; ?></td>
                    <td align="center"><?php echo $row["C_Category"]; ?></td>
                    <td align="center"><?php echo $row["q_quantityofmilk"]; ?></td>
                    <td align="center"><?php echo $row["qc_fat_content"] ?? ''; ?></td>
                    <td align="center"><?php echo isset($row["price"]) ? number_format($row["price"], 2) : ''; ?></td>
                </tr>
            <?php
                $count++; 
            }
            ?>
        </tbody>
    </table>
</body>
</html>
