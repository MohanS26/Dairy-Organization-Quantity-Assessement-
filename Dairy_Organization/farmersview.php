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
    padding: 17px;
    text-align: center;
    border: 1px solid #ddd;
    color: white;
}

td {
    color: black;
    padding: 7px;
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


th:last-child {
    border-right: none;
}


tbody td:last-child {
    border-right: none;
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


a.checking-button {
    display: inline-block;
    padding: 10px 20px;
    background: linear-gradient(to bottom, #3498db, #2980b9); 
    color: #fff; 
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease;
}

a.checking-button:hover {
    background: linear-gradient(to bottom, #2980b9, #1f6690); 
}

</style>
<script>
  function redirectToChecking(farmersNo, name, date, quantityofmilk) {
    var url = 'quantitychecking.php?' +
        'farmers_no=' + encodeURIComponent(farmersNo) +
        '&name=' + encodeURIComponent(name) +
        '&date=' + encodeURIComponent(date) +
        '&quantityofmilk=' + encodeURIComponent(quantityofmilk);

    window.location.href = url;
  }
</script>
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
                        <th><strong>S.No</strong></th>
                        <th><strong>Farmers Name</strong></th>
                        <th ><strong>Farmers No</strong></th>
                        <th><strong>Address</strong></th>
                        <th><strong>Date</strong></th>
                        <th ><strong>Phone Number</strong></th>
                        <th><strong>Category</strong></th>
                        <th><strong>Quantity of Milk</strong></th>
                        <th>Checker</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    $sel_query = "SELECT f.farmers_no, f.name, f.address, f.date as f_date, f.phoneno, C.Category AS C_Category, C.date as C_date, q.quantityofmilk AS q_quantityofmilk, q.date as q_date
              FROM farmers AS f
              LEFT JOIN cowsinfo AS C ON f.farmers_no = C.farmers_no And f.date = C.date
              LEFT JOIN quantityfarmers AS q ON f.farmers_no = q.farmers_no And  f.date = q.date
              WHERE f.date = '$current_date'
              ORDER BY f.farmers_no DESC;";


                    $result = mysqli_query($con, $sel_query);

                    if (!$result) {
                        die("Error in records query: " . mysqli_error($con));
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td align="center"><?php echo $count; ?></td>
                            <td align="center"><?php echo $row["name"]; ?></td>
                            <td align="center"><?php echo $row["farmers_no"]; ?></td>
                            <td align="center"><?php echo $row["address"]; ?></td>
                            <td align="center"><?php echo $row["f_date"]; ?></td>
                            <td align="center"><?php echo $row["phoneno"]; ?></td>
                            <td align="center"><?php echo $row["C_Category"]; ?></td>
                            <td align="center"><?php echo $row["q_quantityofmilk"]; ?></td>
                        
                            
                            <td align="center">
                            <a href="#" class="checking-button" onclick="redirectToChecking(
    '<?php echo $row['farmers_no']; ?>',
    '<?php echo $row['name']; ?>',
    '<?php echo $row['f_date']; ?>',
    '<?php echo $row['q_quantityofmilk']; ?>')">Checking</a>
 </tr>
                        <?php $count++;
                    } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</body>
</html>