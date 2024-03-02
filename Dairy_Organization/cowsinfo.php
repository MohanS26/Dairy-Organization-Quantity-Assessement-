<?php
include("auth.php");
require('db.php');
$status = "";
if (isset($_POST['new']) && $_POST['new'] == 1) {
    $farmers_no = $_REQUEST['farmers_no'];
    $Category = $_REQUEST['Category'];
    $Maximam_Cows = $_REQUEST['Maximam_Cows'];
    $date = $_REQUEST['date'];

    if (empty($farmers_no) || empty($Category) || empty($Maximam_Cows) || empty($date)) {
        $status = "All fields are required.";
    } elseif (!preg_match("/^[0-9]+$/", $farmers_no)) {
        $status = "Farmers No should contain only numbers.";
    } elseif (!in_array($Category, ['Cows', 'Buffalo'])) {
        $status = "Invalid Category type.";
    } elseif (!preg_match("/^[0-9]+$/", $Maximam_Cows)) {
        $status = "Maximum Animal should contain only numbers.";
    } else 

    $ins_query = "INSERT INTO cowsinfo ( `farmers_no`, `Category`, `Maximam_Cows`, `date`)
                  VALUES ( '$farmers_no', '$Category', '$Maximam_Cows', '$date')";

    mysqli_query($con, $ins_query) or die(mysqli_error($con));
    $status = "New Record Inserted Successfully.";
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
input[type=email],
select[name=Category] {
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
           
            <h1><center>Cows Details</center></h1>
            <?php if (!empty($status)) { ?>
                <div class="success-message">
                    <p><?php echo $status; ?></p>
                </div>
            <?php } ?>
            </div>
            <form name="form" method="post" action="">
                <input type="hidden" name="new" value="1" />

                <div class="form-group">
    <label for="farmers_no">Farmers No</label>
    <input type="text" id="farmers_no" name="farmers_no" placeholder="Enter Farmers No" value="<?php echo $_SESSION['farmers_no']; ?>" required />
</div>

                <div class="form-group">
                    <label for="Category">Category</label>
                    <select name="Category">
                        <option value="">Category Types</option>
                        <option value="Cows">Cows</option>
                        <option value="Buffalo">Buffalo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Maximam_Cows">Maximum Animal</label>
                    <input type="text" id="Maximam_Cows" name="Maximam_Cows" placeholder=" Enter the Maximam Cows"
                        required />
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" placeholder="Date" required />
                </div>

                <input class="submit-btn-add" name="submit" type="submit" value="Submit" />
                
            </form>
        </div>
    </div>
</body>

</html>
