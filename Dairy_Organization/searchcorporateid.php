
<?php
include("auth.php");
require('db.php');


$count = 1;


if (isset($_POST['search'])) {
    
    $searchCorporateno = mysqli_real_escape_string($con, $_POST['corporateno']);

 
    $sel_query = "SELECT c.*, ch.date as ch_date, ch.fat_content as ch_fat_content, ch.quantity as ch_quantity, ch.profit_percentage as ch_profit_percentage, ch.final_price
    FROM corporate c
    LEFT JOIN corporatechecking ch ON c.name = ch.name AND c.date = ch.date
    WHERE c.corporateno = '$searchCorporateno'";

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
    background-color: darkseagreen;
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
}


th, td {
    border: 1px solid #fff;
    padding: 15px;
    text-align: center;
    color: #fff;
    border: 0px solid #ddd;
    font-size: 18px; 
    font-weight: 600; 
}

th {
    background-color: #333;
    color: white;
}

td {
    background-color: #555;
}

tr:hover td {
    background-color: gray;
    color: black;
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
        <h2>Search Corporate Records</h2>

       
        <form method="post" action="">
            <label for="corporateno">Corporate No:</label>
            <input type="text" name="corporateno" id="corporateno" required />
            <input type="submit" name="search" value="Search">
        </form>

       
        <?php if (isset($search_result) && $search_result && mysqli_num_rows($search_result) > 0): ?>
            
            <table width="100%" border="1" style="border-collapse: collapse;">
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
                    <?php while ($row = mysqli_fetch_assoc($search_result)): ?>
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
                        <?php $count++; ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p></p>
        <?php endif; ?>
    </div>
</body>
</html>