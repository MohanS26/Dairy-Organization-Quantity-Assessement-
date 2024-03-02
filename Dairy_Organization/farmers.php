<?php
include("auth.php");
require('db.php');
$status = "";


if (isset($_POST['new']) && $_POST['new'] == 1) {
    $trn_date = date("Y-m-d H:i:s");
    $farmers_no = $_REQUEST['farmers_no'];
    $name = $_REQUEST['name'];
    $address = $_REQUEST['address'];
    $email = $_REQUEST['email'];
    $date = $_REQUEST['date'];
    $phoneno = $_REQUEST['phoneno'];

    
    if (empty($farmers_no) || empty($name) || empty($address) || empty($email) || empty($date) || empty($phoneno)) {
        $status = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status = "Invalid email format.";
    } elseif (!preg_match("/^[0-9]{10}$/", $phoneno)) {
        $status = "Invalid phone number format. It should be a 10-digit number.";
    } else {
       
        $ins_query = "INSERT INTO farmers (`trn_date`,`farmers_no`,`name`,`address`,`email`,`date`,`phoneno`) VALUES ('$trn_date','$farmers_no','$name','$address','$email','$date','$phoneno')";
        mysqli_query($con, $ins_query) or die(mysqli_error($con));
        $status = "New Record Inserted Successfully.";
    }
}

?>
<?php
session_start();
if (!isset($_SESSION['farmers_no']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
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
            background-image: url('img/2\ \(1\).jpg');
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
        <div>
            <div class="form-group">
                
                <h1>Farmers Details</h1>
                <?php if (!empty($status) && strpos($status, "New Record Inserted Successfully") !== false) { ?>
                        <div class="success-message">
                            <p><?php echo $status; ?></p>
                        </div>
                    <?php } ?>
                <div class="form-group"> </div>
                <form name="form" method="post" action="">
                    <input type="hidden" name="new" value="1" />

                    <div class="form-group">
                        <label for="farmers_no">Farmers No</label>
                        <input type="text" id="farmers_no" name="farmers_no" placeholder="Enter Farmers No" value="<?php echo isset($_POST['farmers_no']) ? $_POST['farmers_no'] : $_SESSION['farmers_no']; ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter Name of Farmers" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $_SESSION['username']; ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Enter Address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required />
                        <?php if (!empty($status) && strpos($status, "Invalid email") !== false) { ?>
                            <p style="color: red;"><?php echo $status; ?></p>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" placeholder="Date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="phoneno">Phone Number</label>
                        <input type="text" id="phoneno" name="phoneno" placeholder="Enter Phone Number" value="<?php echo isset($_POST['phoneno']) ? $_POST['phoneno'] : ''; ?>" required />
                        <?php if (!empty($status) && strpos($status, "Invalid phone number") !== false) { ?>
                            <p style="color: red;"><?php echo $status; ?></p>
                        <?php } ?>
                    </div>

                    <input class="submit-btn-add" name="submit" type="submit" value="Submit" />
                    
                </form>
            </div>
        </div>
    </div>
</body>