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
</style>


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
        <li><a href="farmersmonth.php">Monthly  Collection</a></li>  
    </ul>
</div>
<div class="container">
    <?php
    $sel_query = "SELECT DISTINCT date FROM farmers ORDER BY date DESC;";
    $date_result = mysqli_query($con, $sel_query);

    while ($date_row = mysqli_fetch_assoc($date_result)) {
        $current_date = $date_row['date'];
    ?>
        <div class="form">
            <h1>Farmers Records - <?php echo $current_date; ?></h1>
            <table width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th><strong>ID</strong></th>
                    <th ><strong>Farmers Name</strong></th>
                    <th><strong>Farmers No</strong></th>
                    <th><strong>Date</strong></th>
                    <th><strong>Phone Number</strong></th>
                    <th><strong>Category</strong></th>
                    <th><strong>Minimum Litres</strong></th>
                    <th><strong>Fat Content</strong></th>
                    <th><strong>Price</strong></th>
                </tr>
            </thead>
            <tbody>
            <?php
                    $count = 1;
                    $sel_query = "SELECT f.farmers_no, f.name, f.date as f_date, f.phoneno, C.Category AS C_Category, C.date as C_date, q.quantityofmilk AS q_quantityofmilk, q.date as q_date, qc.fat_content as qc_fat_content,qc.date as qc_date, qc.price
              FROM farmers AS f
              LEFT JOIN cowsinfo AS C ON f.farmers_no = C.farmers_no AND f.date = C.date
              LEFT JOIN quantityfarmers AS q ON f.farmers_no = q.farmers_no AND f.date = q.date
              LEFT JOIN quantitychecking AS qc ON f.farmers_no = qc.farmers_no AND f.date = qc.date
              WHERE f.date = '$current_date'
              ORDER BY f.farmers_id DESC;";

$result = mysqli_query($con, $sel_query);

if (!$result) {
    die("Error in records query: " . mysqli_error($con));
}


                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            
                            <td align="center"><?php echo $count; ?></td>
                            <td align="center"><?php echo $row["name"]; ?></td>
                            <td align="center"><?php echo $row["farmers_no"]; ?></td>
                            <td align="center"><?php echo $row["qc_date"]; ?></td>
                            <td align="center"><?php echo $row["phoneno"]; ?></td>
                            <td align="center"><?php echo $row["C_Category"]; ?></td>
                            <td align="center"><?php echo $row["q_quantityofmilk"]; ?></td>
                            <td align="center"><?php echo $row["qc_fat_content"] ?? ''; ?></td>
                            <td align="center"><?php echo isset($row["price"]) ? number_format($row["price"], 2) : ''; ?></td>
                        </tr>
                    <?php $count++;
                    } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</body>
</html>