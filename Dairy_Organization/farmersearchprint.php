<?php
include("auth.php");
require('db.php');


$search_result = null;

if (isset($_POST['search'])) {
    
    $searchFarmersNo = mysqli_real_escape_string($con, $_POST['farmers_no']);


    $sel_query = "SELECT f.name, f.farmers_no, f.address, f.date, f.phoneno, C.Category AS C_Category, q.quantityofmilk AS qc_quantity, qc.fat_content as qc_fat_content, qc.price
        FROM farmers AS f
        LEFT JOIN cowsinfo AS C ON f.farmers_no = C.farmers_no
        LEFT JOIN quantityfarmers AS q ON f.farmers_no = q.farmers_no
        LEFT JOIN quantitychecking AS qc ON f.farmers_no = qc.farmers_no
        WHERE f.farmers_no = '$searchFarmersNo'
        AND f.date = CURRENT_DATE()
        LIMIT 1;";  

    $search_result = mysqli_query($con, $sel_query);
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
    background-color: lightblue;
    margin: 0;
    padding: 0;
    background-image: url('img/2.jpg');
}

.header {
    position: fixed;
    right: 0;
    top: 0;
    width: 100%;
    background-color: black;
    color: white;
    text-align: center;
    padding: 10px; 
}

.list {
    float: right;
    margin-right: 40px;
}

.list li {
    display: inline-block;
    margin-right: 30px;
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

.receipt {
    width: 500px;
    margin: 40px auto; 
    padding: 70px;
    background: linear-gradient(to right, #d2a679, #d2a679); 
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
}

h1 {
    color: black;
    text-align: center;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;   
}



form {
    text-align: center
    
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: black;
    text-align: center;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;   
    font-size: larger;
}

input[type="text"] {
    width: 200px;
    padding: 8px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background: linear-gradient(to right, green, yellow); 
}


.print-button {
    display: block;
    width: 200px; 
    margin: 20px auto; 
    padding: 10px 20px;
    background: linear-gradient(to right, green, lightgreen); 
    color: Black;
    font-weight: bold;
    text-decoration: none;
    border-radius: 5px;
    text-align: center; 
    cursor: pointer;
}

#logo {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 120px;
            height: auto; 
        }



.message {
    background-color: #f8d7da; 
    padding: 10px;
    border-radius: 4px;
    color: #721c24; 
    font-weight: bold;
    text-align: center;
    margin: 20px 0;
}


    </style>
</head>
<body>

<div class="header">
    <ul class="list">
    <img id="logo" src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="Logo">
    <li><a href="Homepage.php">Home</a></li>
            <li><a href="farmers.php">Farmer Details</a></li>
            <li><a href="cowsinfo.php">Cows Info</a></li>
            <li><a href="quantityfarmers.php">Quantity</a></li>
            <li><a href="farmersearchprint.php">Bill</a></li>
    </ul>
</div>

<div class="receipt">
    <h1>Payment Receipt</h1>

   
    <form method="post" action="">
        <label for="farmers_no"> Farmer's No:</label>
        <input type="text" name="farmers_no" id="farmers_no" required>
        <input type="submit" name="search">
    </form>

   
    <?php if (isset($_POST['search'])): ?>
        <?php if ($search_result !== null): ?>
            <?php if (mysqli_num_rows($search_result) > 0): ?>
             
                <a href="farmersprint.php?farmers_no=<?php echo $searchFarmersNo; ?>" target="farmers_no" class="print-button">Print Receipt</a>
            <?php else: ?>
                <p class= "message">No  Farmer Registered Today </p>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>

