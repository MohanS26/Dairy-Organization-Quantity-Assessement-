<?php
include("auth.php");
require('db.php');


if (isset($_POST['submit'])) {
    $selectedDate = $_POST['selectedDate'];

    
    $sel_query = "SELECT f.farmers_no, f.name, f.date as f_date, f.phoneno, C.Category AS C_Category, C.date as C_date, q.quantityofmilk AS q_quantityofmilk, q.date as q_date, qc.fat_content as qc_fat_content, qc.date as qc_date, qc.price
                  FROM farmers AS f
                  LEFT JOIN cowsinfo AS C ON f.farmers_no = C.farmers_no AND f.date = C.date
                  LEFT JOIN quantityfarmers AS q ON f.farmers_no = q.farmers_no AND f.date = q.date
                  LEFT JOIN quantitychecking AS qc ON f.farmers_no = qc.farmers_no AND f.date = qc.date
                  WHERE f.date = '$selectedDate'
                  ORDER BY qc.fat_content DESC, f.farmers_id DESC;";

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
    color: black;
    text-align: center;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
   
}


h3 {
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



input[type="date"] {
    width: 15%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

/* Button style */
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
            background-color: darkcyan;
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
        <ul class="list">
            <img id="logo" src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="Logo">
            <li><a href="Homepage.php">Home</a></li>
            <li><a href="dashboard.php"> Dashboard</a></li>
            <li><a href="farmersview1.php">Farmers Records</a></li>
            <li><a href="farmerstotalquantity.php">Total  Collection</a></li>
            <li><a href="farmersmonth.php">Monthly  Collection</a></li>  
        </ul>
    </div>

    <div id="welcome-title">
        <h2>Overall One Day Collection</h2>
        <form method="post" action="">
            <label for="selectedDate">Select Date:</label>
            <input type="date" id="selectedDate" name="selectedDate" required><br>
            <input type="submit" name="submit" value="View Collection">
        </form>
    </div>

    <div class="container">
        <div class="form">
            <?php
            if (isset($result)) { 
            ?>
                <div class="form">
                    <h1>Farmers Records - <?php echo $selectedDate; ?></h1>
                    <?php
                    $prevFatContent = null;
                    $count = 1;
                    $totalFat = 0;
                    $totalQuantity = 0;
                    $totalPrice = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $fatContent = $row["qc_fat_content"];

                       
                        if ($prevFatContent !== $fatContent) {
                            if ($prevFatContent !== null) {

                                echo "</tbody>";
                                echo "<tfoot>";
                                echo "<tr>";
                                echo "<td colspan='4'></td>";
                                echo "<td align='center'>$totalFat</td>";
                                echo "<td align='center'>$totalQuantity</td>";
                                echo "<td align='center'>$totalPrice</td>";
                                echo "</tr>";
                                echo "</tfoot>";
                                echo "</table>";
                            }

                            echo "<h3>Farmers Records - Fat Content: $fatContent%</h3>";
                            ?>
                            <table width="100%" border="1" style="border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <th><strong>ID</strong></th>
                                        <th><strong>Farmers Name</strong></th>
                                        <th><strong>Farmers No</strong></th>
                                        <th><strong>Date</strong></th>
                                        <th><strong>Fat Content</strong></th>
                                        <th><strong>Minimum Litres</strong></th>
                                        <th><strong>Price</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                            $prevFatContent = $fatContent;
                            $count = 1;
                            $totalFat = 0;
                            $totalQuantity = 0;
                            $totalPrice = 0;
                        }

                        
                        $totalFat += $row["qc_fat_content"];
                        $totalQuantity += $row["q_quantityofmilk"];
                        $totalPrice += $row["price"];
                        ?>
                        <tr>
                            
                            <td align="center"><?php echo $count; ?></td>
                            <td align="center"><?php echo $row["name"]; ?></td>
                            <td align="center"><?php echo $row["farmers_no"]; ?></td>
                            <td align="center"><?php echo $row["qc_date"]; ?></td>
                            <td align="center"><?php echo $row["qc_fat_content"]; ?></td>
                            <td align="center"><?php echo $row["q_quantityofmilk"]; ?></td>
                            <td align="center"><?php echo isset($row["price"]) ? number_format($row["price"], 2) : ''; ?></td>
                        </tr>
                        <?php
                        $count++;
                    }

                    
                    if ($prevFatContent !== null) {
                        echo "</tbody>";
                        echo "<tfoot>";
                        echo "<tr>";
                        echo "<td colspan='4'></td>";
                        echo "<td align='center'>$totalFat</td>";
                        echo "<td align='center'>$totalQuantity</td>";
                        echo "<td align='center'>$totalPrice</td>";
                        echo "</tr>";
                        echo "</tfoot>";
                        echo "</table>"; 
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>