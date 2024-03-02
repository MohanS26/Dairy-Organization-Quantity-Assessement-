<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<style>
        body {
            font-family:  'Arial Narrow Bold', sans-seriff;
            margin: 0;
            padding: 0;
            background-color: #9f0;
           background-image: url(img/15.jpg);
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
            color: white;
            font-family: serif;
            font-weight: bold;
        }

        .list li:hover {
            border-bottom: 4px solid yellow;
            transition: .3s;
        }

        .input-group {
    width: 100%;
    max-width: 17em;
    background: rgba(255, 255, 255, 0.2);
    padding: 60px; 
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

        h1 {
            color: #fff;
            font-size: 2em;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
            color: #fff;
            font-size: 0.875em;
            letter-spacing: 0.1em;
        }

        input {
            color: red;
            font-size: 0.80rem;
            line-height: 1;
            border: 0.25em solid transparent;
            background-image: linear-gradient(#000, #000),
                linear-gradient(120deg, #f09 0%, #0ff 50%, #9f0 100%);
            background-origin: border-box;
            background-clip: padding-box, border-box;
            border-radius: 1.8em;
            background-size: 200% 100%;
            transition: background-position 0.8s ease-out;
            width: 100%;
            padding: 0.8em 1em;
            margin-bottom: 16px;
        }

        
        input:hover {
            background-position: 100% 0;
        }

        input:focus {
            outline: 2px dashed #ad2b89;
            outline-offset: 0.5em;
        }

        input[type="submit"] {
            background-color: #006;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #004080;
        }
      

.message-container {
    width: 80%;
    margin: 20px auto;
    padding: 10px;
    text-align: center;
    border-radius: 14px;
}

.success-message {
    background-color: blue; 
    color: white;
}

.error-message {
    background-color: #f44336; 
    color: white;
}

    </style>
    
<script>
    function validateForm() {
        var username = document.forms["registration"]["username"].value;
        var email = document.forms["registration"]["email"].value;
        var password = document.forms["registration"]["password"].value;

        if (username === null || username === "") {
            alert("Username can't be blank");
            return false;
        }

     
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Invalid email address");
            return false;
        }

        
        if (password.length < 8) {
            alert("Password must be at least 8 characters long.");
            return false;
        }

        var hasLowerCase = /[a-z]/.test(password);
        var hasUpperCase = /[A-Z]/.test(password);
        var hasDigit = /\d/.test(password);
        var hasSpecialChar = /[!@#\$%\^&\*]/.test(password);

        if (!(hasLowerCase && hasUpperCase && hasDigit && hasSpecialChar)) {
            alert("Password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.");
            return false;
        }

        return true;
    }
</script>
</head>
<body>
<?php
require('db.php');
session_start(); 


$registrationSuccess = false;


if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $trn_date = date("Y-m-d H:i:s");

    
    $checkColumnQuery = "SHOW COLUMNS FROM login LIKE 'farmers_no'";
    $checkColumnResult = mysqli_query($con, $checkColumnQuery);

    if (!$checkColumnResult) {
        die("Error checking column: " . mysqli_error($con));
    }

    $columnExists = mysqli_num_rows($checkColumnResult) > 0;

   
    if (!$columnExists) {
        $addColumnQuery = "ALTER TABLE login ADD COLUMN farmers_no INT";
        $addColumnResult = mysqli_query($con, $addColumnQuery);

        if (!$addColumnResult) {
            die("Error adding 'farmers_no' column: " . mysqli_error($con));
        }
    }


    $latestFarmersNoQuery = "SELECT farmers_no FROM login ORDER BY farmers_no DESC LIMIT 1";
    $result = mysqli_query($con, $latestFarmersNoQuery);

    if (!$result) {
        die("Error fetching latest farmers_no: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    $latestFarmersNo = $row['farmers_no'];

    
    $initialFarmersNo = 101;

    
    if ($latestFarmersNo < $initialFarmersNo) {
        $latestFarmersNo = $initialFarmersNo - 1;
    }

    
    $newFarmersNo = $latestFarmersNo + 1;

    
    $query = "INSERT INTO `login` (username, password, email, trn_date, farmers_no)
              VALUES ('$username', '" . md5($password) . "', '$email', '$trn_date', '$newFarmersNo')";

    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error inserting data into the database: " . mysqli_error($con));
    }

    $registrationSuccess = true;
    $_SESSION['newFarmersNo'] = $newFarmersNo;
}

?>

<body>
    <div class="header">
        <ul class="list">
            <li><a href="Homepage.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div>
    <div class="input-group">
        <h1>Registration</h1>
        <?php if ($registrationSuccess) { ?>
            <div class='message-container success-message'>
                <h3>You are registered successfully</h3>
                <p>Your Farmers No: <?php echo $newFarmersNo; ?></p>
            </div>
        <?php } else { ?>
            <form name="registration" action="" method="post" onsubmit="return validateForm()">
                
                <input type="text" name="username" placeholder="Username" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="submit" name="submit" />
            </form>
        <?php } ?>
    </div>
</body>
</html>