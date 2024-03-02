
<?php
include("auth.php");
require('db.php');


if(isset($_POST['search'])){
   
    $searchFarmersNo = mysqli_real_escape_string($con, $_POST['farmers_no']);
    
   
    $sel_query = "SELECT f.farmers_no, f.name, f.date as f_date, f.phoneno, C.Category AS C_Category, C.date as C_date, q.quantityofmilk AS q_quantityofmilk, q.date as q_date, qc.fat_content as qc_fat_content, qc.date as qc_date, qc.price
    FROM farmers AS f
    LEFT JOIN cowsinfo AS C ON f.farmers_no = C.farmers_no AND f.date = C.date
    LEFT JOIN quantityfarmers AS q ON f.farmers_no = q.farmers_no AND f.date = q.date
    LEFT JOIN quantitychecking AS qc ON f.farmers_no = qc.farmers_no AND f.date = qc.date
    WHERE f.farmers_no = '$searchFarmersNo'";

    $search_result = mysqli_query($con, $sel_query);

    if (!$search_result) {
        die("Error in search query: " . mysqli_error($con));
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers Records</title>
    <style>
     

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.header {
    position: fixed;
    right: 0;
    top: 0;
    width: 100%;
    height: 60px;
    background-color: black;
    color: white;
    text-align: center;
    padding: 0px;
}

.list {
    float: right;
    margin-right: 40px;
}

.list li {
    display: inline-block;
    margin-right: 30px;
    margin-top: 0px;
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

.container {
    font-size: 26px;
    color: #fff;
    text-align: center;
    margin-top: 80px;
    border-bottom: 2px solid #fff;
    padding-bottom: 7px;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    background-color: lightslategray;
    position: relative;
    margin-bottom: 20px;
}

h2 {
    color: #333;
    text-align: center;
}


form {
    margin-bottom: 20px;
    text-align: center;
}

label {
    margin-right: 10px;
    color: #333;
}

input[type="text"] {
    padding: 10px;
    margin-bottom: 10px; 
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #006;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #004080;
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
    padding: 17px;
    text-align: center;
    border: 1px solid #ddd;
    color: white;
}

td {
    color: black;
    padding: 15px;
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
        <h2> Search Farmers Records</h2>

      
        <form method="post" action="">
            <label for="farmers_no"> Farmer's No:</label>
            <input type="text" name="farmers_no" id="farmers_no" required>
            <input type="submit" name="search" value="Search">
        </form>

      
        <?php if(isset($search_result) && mysqli_num_rows($search_result) > 0): ?>
            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>ID</strong></th>
                        <th ><strong>Farmers Name</strong></th>
                        <th><strong>Farmers No</strong></th>
                        <th><strong>Date</strong></th>
                        <th><strong>Phone Number</strong></th>
                        <th><strong>Category</strong></th>
                        <th><strong>Minimum Liters</strong></th>
                        <th>Fat Content </th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($search_result)): ?>
                        <tr>
                            <td align="center">1</td>
                            <td align="center"><?php echo $row["name"]; ?></td>
                            <td align="center"><?php echo $row["farmers_no"]; ?></td>
                            <td align="center"><?php echo $row["qc_date"]; ?></td>
                            <td align="center"><?php echo $row["phoneno"]; ?></td>
                            <td align="center"><?php echo $row["C_Category"]; ?></td>
                            <td align="center"><?php echo $row["q_quantityofmilk"]; ?></td>
                            <td align="center"><?php echo $row["qc_fat_content"]; ?></td>
                            <td align="center"><?php echo number_format($row["price"], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
