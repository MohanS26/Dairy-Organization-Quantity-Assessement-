<?php
include("auth.php");
require('db.php');


if (isset($_POST['submit'])) {
    $selectedDate = $_POST['selectedDate'];

    
    $sel_query = " SELECT c.*, ch.date as ch_date, ch.fat_content as ch_fat_content, ch.quantity as ch_quantity, ch.profit_percentage as ch_profit_percentage, ch.price as ch_price, ch.final_price
    FROM corporate c
    LEFT JOIN corporatechecking ch ON c.name = ch.name AND c.date = ch.date
    WHERE c.date = '$selectedDate'
    ORDER BY c.id DESC;";
    $result = mysqli_query($con, $sel_query);

    if (!$result) {
        die("Error in records query: " . mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Farmers Records</title>
<style>
body {
            font: 16px/1.3 "Serif", sans-serif;
            background: #123;
            margin: 0; 
            padding: 0; 
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
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000; 
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

        .container {
            margin: 50px auto 20px; 
        }

    .form {
        margin-top: 90px;
    }

    h1 {
    color: white;
    text-align: center;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
   
}

h2 {
    color: darkblue;
    text-align: center;
}

label{
    color: darkmagenta;
    font-weight: bold;
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
    
    text-align: center;
    color: #fff;
    border: 0px solid #ddd;
    font-size: 16px; 
    font-weight: 600; 
}


th {
    background-color: #333;
    color: white;
    padding: 18px;
}


td {
    background-color: #555;
    padding: 18px;
}


tr:hover td {
    background-color:gray ;
    color: black; 
}

.total {
    background-color: #333 ; 
    color: white; 
    text-align: center;
    font-size: 16px;
    font-weight: 600;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}


input[type="date"] {
    width: 15%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}


input[type="submit"] {
    background-color: #3498db;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #2980b9;
}

#welcome-title {
            font-size: 26px;
            color: #fff;
            text-align: center;
            margin-top: 80px;
            border-bottom: 2px solid #fff;
            padding-bottom: 7px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            background-color: lightslategray;
            position: relative;
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
<div class="header">
    <ul class="list">
    <img id="logo" src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="Logo">
        <li><a href="Homepage.php">Home</a></li>
        <li><a href="dashboard.php"> Dashboard</a></li>
        <li><a href="corporateview1.php">Corporate Records</a></li>
        <li><a href="corporatetotalquantity.php">Total Collection</a></li>
        <li><a href="corporatemonth.php">Monthly Collection</a></li>
    </ul>
</div>
</div>

    <div id="welcome-title">
        <h2>Overall One Day Collection</h2>
        <form method="post" action="">
            <label for="selectedDate">Select Date:</label>
            <input type="date" id="selectedDate" name="selectedDate" required><br>
            <input type="submit" name="submit" value="View Collection">
        </form>
    </div>
    </div>
    <div class="container">
    <?php
if (isset($result)) { 
    $currentFatContent = null;
    $totalQuantity = 0;
    $totalFat_content = 0;
    $totalPrice = 0;
    $totalFinalPrice = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        if ($currentFatContent !== $row["ch_fat_content"]) {
            
            if ($currentFatContent !== null) {
                echo '</tbody>';
                echo '<tfoot>';
                echo '<tr>';
                echo '<td colspan="3"></td>';
                echo '<td class="total">Total</td>';
                echo '<td class="total" align="center">' . number_format($totalQuantity, 2) . '</td>';
                echo '<td class="total" align="center">' . number_format($totalFat_content, 2) . '</td>';
                echo '<td class="total" align="center">' . number_format($totalPrice, 2) . '</td>';
                echo '<td class="total" align="center">' . number_format($totalFinalPrice - $totalPrice, 2) . '</td>';
                echo '<td class="total" align="center">' . number_format($totalFinalPrice, 2) . '</td>';
                echo '</tr>';
                echo '</tfoot>';
                echo '</table>';
            }


            echo '<div class="form">';
            echo '<h1>Corporate Records - ' . $selectedDate . ' <br> Fat Content: ' . $row["ch_fat_content"] . '</h1>';
            echo '<table width="100%" border="1" style="border-collapse:collapse;">';
            echo '<thead>';
            echo '<tr>';
            echo '<th><strong>ID</strong></th>';
            echo '<th><strong>Corporate Name</strong></th>';
            echo '<th><strong>Corporate No</strong></th>';
            echo '<th><strong>Date</strong></th>';
            echo '<th><strong>Minimum Litres</strong></th>';
            echo '<th><strong>Fat Content</strong></th>';
            echo '<th><strong>Original Price</strong></th>';
            echo '<th><strong>Profit price</strong></th>';
            echo '<th><strong>Total price</strong></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            
            $totalQuantity = 0;
            $totalFat_content = 0;
            $totalPrice = 0;
            $totalFinalPrice = 0;
            $count = 1;
            
            $currentFatContent = $row["ch_fat_content"];
        }

        
        $totalQuantity += $row["ch_quantity"];
        $totalFat_content += $row["ch_fat_content"];
        $totalPrice += $row["ch_price"];
        $totalFinalPrice += $row["final_price"];
        $priceDifference = $row["final_price"] - $row["ch_price"];
        ?>
        <tr>
           
            <td align="center"><?php echo $count; ?></td>
            <td align="center"><?php echo $row["name"]; ?></td>
            <td align="center"><?php echo $row["corporateno"]; ?></td>
            <td align="center"><?php echo $row["ch_date"]; ?></td>
            <td align="center"><?php echo $row["ch_quantity"]; ?></td>
            <td align="center"><?php echo $row["ch_fat_content"]; ?></td>
            <td align="center"><?php echo $row["ch_price"]; ?></td>
            <td align="center"><?php echo number_format($priceDifference, 2); ?></td>
            <td align="center"><?php echo number_format($row["final_price"], 2); ?></td>
        </tr>
        <?php 
        $count++;
    }

    
    if ($currentFatContent !== null) {
        echo '</tbody>';
        echo '<tfoot>';
        echo '<tr>';
        echo '<td colspan="3"></td>';
        echo '<td class="total">Total</td>';
        echo '<td class="total" align="center">' . number_format($totalQuantity, 2) . '</td>';
        echo '<td class="total" align="center">' . number_format($totalFat_content, 2) . '</td>';
        echo '<td class="total" align="center">' . number_format($totalPrice, 2) . '</td>';
        echo '<td class="total" align="center">' . number_format($totalFinalPrice - $totalPrice, 2) . '</td>';
        echo '<td class="total" align="center">' . number_format($totalFinalPrice, 2) . '</td>';
        echo '</tr>';
        echo '</tfoot>';
        echo '</table>';
    }
}
?>

        </div>
    </div>
</body>

</html>
