
<?php
include("auth.php");
require('db.php');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $farmers_no =$_REQUEST['farmers_no'];
    $date = $_REQUEST['date'];
    $quantityofmilk = $_REQUEST['quantityofmilk'];
    
    {
    $ins_query="insert into quantityfarmers
    ( `farmers_no`,`date`,`quantityofmilk`)values
    ( '$farmers_no','$date','$quantityofmilk')";
    mysqli_query($con,$ins_query)
    or die(mysqli_error($con));
    $status = "New Record Inserted Successfully";
    }
    
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Farmers</title>
    <style>
          body,
        h1,
        h2,
        h3,
        p,
        div,
        form {
            margin: 0;
            padding: 0;
        }

       
        body {
            background-image: url('img/5.jpg');
        }

        h1 {
            color: darkred; 
            text-align: center;
        }

        
        .header {
            position: fixed;
            right: 0;
            top: 0;
            width: 100%;
            background-color: black;
            color: white;
            text-align: center;
        }

    
        .list {
            float: right;
            margin-right: 40px;
            padding-top: 10px; 
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

      
        .form {
            width: 30%;
            margin: 100px auto; 
            background: linear-gradient(to right, #d2a679, #a52a2a); 
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        
        .form-group {
            margin-bottom: 15px;
        }

        
        input[type=text],
        input[type=number],
        input[type=date],
        input[type=email] {
            width: 100%;
            padding: 12px;
            display: inline-block;
            border: 1px solid #34495e; 
            box-sizing: border-box;
            border-radius: 15px; 
            background-color: #ecf0f1; 
            color: #2c3e50;
            font-weight: bold;
            font-size: medium; 
        }

       
        input[type=radio] {
            margin-right: 5px;
        }

       
        input.submit-btn-add {
            background: linear-gradient(
                82.3deg,
                rgb(250, 74, 5) 10.8%,
                rgba(99, 88, 238, 1) 94.3%
            );
            color: white;
            padding: 14px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

      
        input.submit-btn-add:hover {
            opacity: 0.8;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

       
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: large;
            color: black; 
        }

       
        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #04AA6D;
        }

      
        a:hover {
            color: #333;
        }

        
        .success-message {
            color: #04AA6D;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            width: 60%;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            border-radius: 14px;
            background-color: blue; 
            color: white;
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
            <li><a href="farmers.php">Farmer Details</a></li>
            <li><a href="cowsinfo.php">Cows Info</a></li>
            <li><a href="quantityfarmers.php">Quantity</a></li>
            <li><a href="farmersearchprint.php">Bill</a></li>
        </ul>
    </div>
    <div class="form">
        <div class="form-group">
        <?php if (!empty($status)) { ?>
                <div class="success-message">
                    <p><?php echo $status; ?></p>
                </div>
            <?php } ?>
            <h1><center>Quantity Details</center></h1>
        </div>
        <form name="form" method="post" action="">
            <input type="hidden" name="new" value="1" />

            <div class="form-group">
                <label for="farmers_no">Farmers No</label>
                <div class="input">
                <input type="text" id="farmers_no" name="farmers_no" placeholder="Enter Farmers No" value="<?php echo $_SESSION['farmers_no']; ?>" required />
                    <span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <div class="input">
                    <input type="date" id="date" name="date" placeholder="Date" required />
                    <span></span>
                </div>
            </div>

            <div class="form-group">
                <label for="quantityofmilk">Minimum Litres</label>
                <div class="input">
                    <input type="text" id="quantityofmilk" name="quantityofmilk" placeholder="Minimum Litres"
                        required />
                    <span></span>
                </div>
            </div>

            <input class="submit-btn-add" name="submit" type="submit" value="Submit" />
                </div>
            </div>
        </form>
    </div>
</body>

</html>
