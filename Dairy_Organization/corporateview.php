<?php
include("auth.php");
require('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Farmers Records</title>
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
    padding: 8px;
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
    a.checking-button {
    display: inline-block;
    padding: 10px 20px;
    background: linear-gradient(#333 , #2980b9); 
    color: #fff; 
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease;
}

a.checking-button:hover {
    background: linear-gradient(violet,blue); 
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
  function redirectToChecking(corporateno, name, date,fat_content, quantity) {
    var url = 'corporatechecking.php?' +
        'corporateno=' + encodeURIComponent(corporateno) +
        '&name=' + encodeURIComponent(name) +
        '&date=' + encodeURIComponent(date) +
        '&fat_content=' + encodeURIComponent(fat_content) +
        '&quantity=' + encodeURIComponent(quantity);

    window.location.href = url;
  }
</script>
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
    while ($date_row = mysqli_fetch_assoc($date_result)) {
      $current_date = $date_row['date'];
    ?>
      <div class="form">
        <h1>Corporate Records - <?php echo $current_date; ?></h1>
        <table>
          <thead>
            <tr>
              <th>S.No</th>
              <th>Corporate No</th>
              <th>Name</th>
              <th>Address</th>
              <th>Date</th>
              <th>Phone Number</th>
              <th>Fat Content</th>
              <th>Quality of Milk</th>
              <th>Checker</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 1;
            $sel_query_records = "SELECT * FROM corporate WHERE date='$current_date' ORDER BY id DESC;";
            $result = mysqli_query($con, $sel_query_records);
            while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row["corporateno"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["address"]; ?></td>
                <td><?php echo $row["date"]; ?></td>
                <td><?php echo $row["phoneno"]; ?></td>
                <td><?php echo $row["fat_content"]; ?></td>
                <td><?php echo $row["quantity"]; ?></td>
                <td>
                <a href="#" class="checking-button" onclick="redirectToChecking(
    '<?php echo $row['corporateno']; ?>',
    '<?php echo $row['name']; ?>',
    '<?php echo $row['date']; ?>',
    '<?php echo $row['fat_content']; ?>',
    '<?php echo $row['quantity']; ?>')">Checking</a>
 </tr>
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
