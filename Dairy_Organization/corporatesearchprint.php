<?php
include("auth.php");
require('db.php');


$search_result = null;


if(isset($_POST['search'])){
   
    $searchCorporateno = mysqli_real_escape_string($con, $_POST['corporateno']);
    

    $sel_query = "SELECT c.*, ch.date as ch_date, ch.fat_content as ch_fat_content, ch.quantity as ch_quantity, ch.profit_percentage as ch_profit_percentage, ch.final_price
    FROM corporate c
    LEFT JOIN corporatechecking ch ON c.name = ch.name AND c.date = ch.date
    WHERE c.corporateno = '$searchCorporateno'
    AND c.date = CURRENT_DATE()
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
    background-image: url('img/60.jpg');
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
    background: linear-gradient(to right, lightblue, darkblue); 
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
    <li><a href="homepage.php">Home</a></li>
        <li><a href="corporate.php">Corporate Details</a></li>
        <li><a href="corporatesearchprint.php">Bill</a></li>
    </ul>
</div>

<div class="receipt">
    <h2>Payment Receipt</h2>

   
    <form method="post" action="">
        <label for="corporateno">Corporate No :</label>
        <input type="text" name="corporateno" id="corporateno" required />
        <input type="submit" name="search">
    </form>

    <?php if (isset($_POST['search'])): ?>
        <?php if ($search_result !== null): ?>
            <?php if (mysqli_num_rows($search_result) > 0): ?>
                <a href="corporateprint.php?corporateno=<?php echo $searchCorporateno; ?>" target="farmers_no" class="print-button">Print Receipt</a>
                <?php else: ?>
                <p class= "message">No  Corporate Registered Today </p>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>