<?php
include("auth.php");
require('db.php');


function calculateMilkPrice($fatContent, $quantityofmilk) {
    
    $basePrice = 34.00;
    $additionalPricePerFat = 1.30;

    $additionalPrice = ($fatContent - 3) * $additionalPricePerFat;

    $totalPrice = $basePrice + $additionalPrice;

    $finalPrice = $totalPrice * $quantityofmilk;

    return $finalPrice;
}


$price = '';
$name = '';


if (isset($_POST['submit'])) {
   
    $farmers_no = mysqli_real_escape_string($con, $_POST['farmers_no']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $fatContent = mysqli_real_escape_string($con, $_POST['fat_content']);
    $quantityofmilk = mysqli_real_escape_string($con, $_POST['quantityofmilk']);

    
    if (!is_numeric($fatContent) || !is_numeric($quantityofmilk)) {
        echo "Please enter valid numeric values for fat content and quantity.";
    } else {
        
        $price = calculateMilkPrice($fatContent, $quantityofmilk);

        
        $insertQuery = "INSERT INTO quantitychecking (farmers_no, name, date, fat_content, quantityofmilk, price) 
                        VALUES ('$farmers_no', '$name', '$date', '$fatContent', '$quantityofmilk', '$price')";

        $result = mysqli_query($con, $insertQuery);

        if ($result) {
            echo "Data successfully inserted into the 'quantitychecking' table for Name $name.";
        } else {
            echo "Error inserting data into the 'quantitychecking' table: " . mysqli_error($con);
        }
    }
}


$farmersNo = $name = $date = $quantityofmilk = '';


if (isset($_GET['farmers_no'])) {
    $farmersNo = $_GET['farmers_no'];
}

if (isset($_GET['name'])) {
    $name = $_GET['name'];
}

if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

if (isset($_GET['quantityofmilk'])) {
    $quantityofmilk = $_GET['quantityofmilk'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Milk Price Calculator</title>

    <script>
function redirectToChecking(farmersNo, name, date, quantityofmilk) {
    console.log("Farmers No:", farmersNo); 
    console.log("Name:", name); 
    console.log("Date:", date);
    console.log("Quantity of Milk:", quantityofmilk);

    var url = 'quantitychecking.php?' +
        'farmers_no=' + encodeURIComponent(farmersNo) +
        '&name=' + encodeURIComponent(name) +
        '&date=' + encodeURIComponent(date) +
        '&quantityofmilk=' + encodeURIComponent(quantityofmilk);

    window.location.href = url;
}
</script>


    <style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #3b5998; 
    margin: 0;
    padding: 0;
    
    background-image: url('img/53.jpg');
}

.container {
    margin: 80px auto;
    max-width: 450px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    background: lightsteelblue;
}

form {
    display: flex;
    flex-direction: column;
    background: linear-gradient(to bottom, #3494e6, #ec6ead);
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
    color: #721c24; 
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
   <script>
    function showResultBox() {
        
        document.getElementById('resultBox').style.display = 'block';
    }
</script>
</head>
<body>

<div class="header">
    <ul class="list">
    <img id="logo" src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="Logo">
    <li><a href="Homepage.php">Home</a></li>
        <li><a href="dashboard.php"> Dashboard</a></li>
        <li><a href="farmersview1.php">Farmers Records</a></li>
    </ul>
</div>

<div class="container">

    <h1>Milk Price Calculator</h1>
    <form method="post" action="" id="milkPriceForm">
    <label for="farmers_no">Farmers No:</label>
    <input type="text" id="farmers_no" name="farmers_no" value="<?php echo $farmersNo; ?>" readonly>
    

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly>
    

    <label for="date">Date:</label>
    <input type="text" id="date" name="date" value="<?php echo $date; ?>" readonly>
    

    <label for="quantityofmilk">Quantity of Milk:</label>
    <input type="text" id="quantityofmilk" name="quantityofmilk" value="<?php echo $quantityofmilk; ?>" readonly>

    <label for="fat_content">Fat Content (%)</label>
    <input type="text" name="fat_content" id="fat_content" placeholder="Enter fat content" required>
    
    <button type="submit" name="submit">Calculate Price</button>

   
<?php if (isset($price) && is_numeric($price)) { ?>
    <div class="result-box">
        <p>Total Price : <?php echo number_format($price, 2); ?></p>
        <p>Name: <?php echo $name; ?></p>
    </div>
<?php } ?>

    </div>
</form>
