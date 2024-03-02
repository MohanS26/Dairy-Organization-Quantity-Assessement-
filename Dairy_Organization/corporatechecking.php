<?php
include("auth.php");
require('db.php');


function calculateMilkPrice($fatContent, $quantity) {
    
    $basePrice = 35.00;
    $additionalPricePerFat = 1.30;


    $additionalPrice = ($fatContent - 3) * $additionalPricePerFat;

   
    $totalPrice = $basePrice + $additionalPrice;

    
    $finalPrice = $totalPrice * $quantity;

    return $finalPrice;
}


function addProfit($price, $profitPercentage) {
    
    $profitAmount = $price * ($profitPercentage / 100);

    
    $priceWithProfit = $price + $profitAmount;

    return $priceWithProfit;
}


if (isset($_POST['submit'])) {

    $corporateno = $_POST['corporateno'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $fatContent = $_POST['fat_content'];
    $quantity = $_POST['quantity'];
    $profitPercentage = $_POST['profit_percentage']; 

    
    if (!is_numeric($fatContent) || !is_numeric($quantity) || !is_numeric($profitPercentage)) {
        echo "Please enter valid numeric values for fat content, quantity, and profit percentage.";
    } else {
        
        $milkPrice = calculateMilkPrice($fatContent, $quantity);

       
        $finalPrice = addProfit($milkPrice, $profitPercentage);

       
        $insertQuery = "INSERT INTO corporatechecking (corporateno, name, date, fat_content, quantity, price, profit_percentage, final_price) 
                        VALUES ('$corporateno', '$name', '$date', '$fatContent', '$quantity', '$milkPrice', '$profitPercentage', '$finalPrice')";
        $result = mysqli_query($con, $insertQuery);

        if ($result) {
            echo "Total Price with Profit: $" . number_format($finalPrice, 2) . "<br>";
            echo "Data successfully stored in the database for Name $name.";
        } else {
            echo "Error storing data in the database: " . mysqli_error($con);
        }
    }
}

if (isset($_GET['corporateno'])) {
    $corporateno = $_GET['corporateno'];
}

if (isset($_GET['name'])) {
    $name = $_GET['name'];
}

if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

if (isset($_GET['quantity'])) {
    $quantity= $_GET['quantity'];
 
}
if (isset($_GET['fat_content'])) {
    $fat_content = $_GET['fat_content'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Milk Price Calculator</title>

    <script>
function redirectToChecking(corporateno, name, date, quantity) {
    console.log("Corporate No:", corporateno);
    console.log("Name:", name);
    console.log("Date:", date);
    console.log("Quantity of Milk:", quantity);

    var url = 'corporatechecking.php?' +
        'corporateno=' + encodeURIComponent(corporateno) +
        '&name=' + encodeURIComponent(name) +
        '&date=' + encodeURIComponent(date) +
        '&quantity=' + encodeURIComponent(quantity); 
    window.location.href = url;
}
</script>
    <style>
      body {
    font-family: 'Arial', sans-serif;
    background-color: #3b5998; 
    margin: 0;
    padding: 0;
    background-image: url('img/58.jpg');
}

.container {
    margin: 80px auto;
    max-width: 450px;
    background-color: lightpink; 
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
    background: linear-gradient(to bottom, #ff7e5f, #feb47b); 
    padding: 20px;
    border-radius: 8px;
}


h1 {
    color: #8b0000; 
    text-align: center;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    
}

label {
    margin-bottom: 8px;
    color: #8b0000; 
    font-weight: bold;
    font-size: larger;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}

input {
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #8b0000;
    border-radius: 4px;
    box-sizing: border-box;
    font-weight: 700;
    font-size: large;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

button {
    background-color: #8b0000; 
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-weight: bold;
}

button:hover {
    background-color: #6b0000; 
}

.header {
    position: fixed;
    right: 0;
    top: 0;
    width: 100%;
    background-color: #000; 
    color: #fff;
    text-align: center;
    padding: 1px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
}

.list {
    float: right;
    margin-right: 40px;
}

.list li {
    display: inline-block;
    margin-right: 20px;
}

.list li a {
    text-decoration: none;
    font-size: 18px;
    color: #fff;
    font-family: serif;
    font-weight: bold;
}

.list li:hover {
    border-bottom: 4px solid #ff0; 
    transition: .3s;
}


.result-box {
    background-color: #f8d7da;
    padding: 10px;
    border-radius: 4px;
    margin-top: 16px;
    font-weight: bold;
    color: #721c24; /
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
        <li><a href="corporateview1.php">Corporate Records</a></li>
        </ul>
    </div>

    <div class="container">
    <h1>Milk Price Calculator</h1>
    <form method="post" action="">
        <label for="corporateno">Corporate No:</label>
        <input type="text" id="corporateno" name="corporateno" value="<?php echo $corporateno; ?>" readonly>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly>

        <label for="date">Date:</label>
        <input type="text" id="date" name="date" value="<?php echo $date; ?>" readonly>

        <label for="quantity">Quantity of Milk:</label>
        <input type="text" id="quantity" name="quantity" value="<?php echo $quantity; ?>" readonly>

        <label for="fat_content">Fat Content (%)</label>
<input type="text" name="fat_content" value="<?php echo $fat_content; ?>" readonly>


        <label for="profit_percentage">Profit Percentage (%)</label>
        <input type="text" name="profit_percentage" placeholder="Enter profit percentage" required>

        <button type="submit" name="submit">Calculate Price</button>

        <?php if (isset($finalPrice)) { ?>
            <div class="result-box">
                <p>Total Price: <?php echo number_format($finalPrice, 2); ?></p>
                <p>Name: <?php echo $name; ?></p>
                <p>Date: <?php echo $date; ?></p>
            </div>
        <?php } ?>
    </form>
</div>
</body>
</html>