<?php
include("auth.php");
require('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Corporate Records</title>
<style>
  body {
    font: 16px/1.3 "Serif", sans-serif;
    
    background: #123;
    margin: 0;
  }

  .container {
    margin: 20px;
  }

  .form {
    margin-top: 100px;
  }

  h2 {
    text-align: center;
    color: white;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px; 
  }

  th, td {
    border: 1px solid #fff;
    padding: 12px;
    text-align: center;
    color: #fff;
  }

  th {
    background-color: #333;
  }

  td {
    background-color: #555;
  }

  a {
    color: #fff;
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
  }

  
  input[type="text"],
  input[type="password"],
  textarea,
  select {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    border-radius: 5px;
    background-color: #fff; 
    color: #555;
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
</style>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div class="header">
    <ul class="list">
      <li><a href="Homepage.php">Home</a></li>
      <li><a href="dashboard.php">Organization Dashboard</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
  <?php
include("auth.php");
require('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Corporate Records</title>
<style>
body {
        font: 16px/1.3 "Serif", sans-serif;
        background: #123;
    }

    .container {
        margin: 10px;
    }

    .form {
        margin-top: 90px;
    }

    h1 {
    color: white;
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

      

    a {
        color: #fff;
        text-decoration: none;
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
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="header">
        <ul class="list">
        <img id="logo" src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="Logo">
        <li><a href="Homepage.php">Home</a></li>
        <li><a href="dashboard.php"> Dashboard</a></li>
        <li><a href="corporateview.php">Corporate Records</a></li>
        <li><a href="corporatetotalquantity.php">Total Collection</a></li>
        <li><a href="corporatemonth.php">Monthly Collection</a></li>
        </ul>
    </div>
    <div class="container">
        <?php
        $sel_query = "SELECT DISTINCT date FROM corporate ORDER BY date DESC;";
        $date_result = mysqli_query($con, $sel_query);

        if (!$date_result) {
            die("Error in date query: " . mysqli_error($con));
        }

        while ($date_row = mysqli_fetch_assoc($date_result)) {
            $current_date = $date_row['date'];
        ?>
            <div class="form">
                <h1>Corporate Records - <?php echo $current_date; ?></h1>
                <table>
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
                        <?php
                        $count = 1;
                        $sel_query_records = "SELECT c.*, ch.date as ch_date, ch.fat_content as ch_fat_content, ch.quantity as ch_quantity, ch.profit_percentage as ch_profit_percentage, ch.price as ch_price ,ch.final_price
                        FROM corporate c
                        LEFT JOIN corporatechecking ch ON c.name = ch.name AND c.date = ch.date
                        WHERE c.date='$current_date'
                        ORDER BY c.id DESC";

                        $result = mysqli_query($con, $sel_query_records);

                        if (!$result) {
                            die("Error in records query: " . mysqli_error($con));
                        }

                        while ($row = mysqli_fetch_assoc($result)) { ?>
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
                        <?php $count++;
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</body>
</html>