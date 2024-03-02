<?php
include("auth.php");
require('db.php');
$status = "";

if (isset($_POST['new']) && $_POST['new'] == 1) {
    $trn_date = date("Y-m-d H:i:s");
    $corporateno = $_POST['corporateno'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    $phoneno = $_POST['phoneno'];
    $fat_content = $_POST['fat_content'];
    $quantity = $_POST['quantity'];

    // Validation checks
    if (empty($corporateno) || empty($name) || empty($address) || empty($date) || empty($phoneno) || empty($fat_content) || empty($quantity)) {
        $status = "All fields are required.";
    } elseif (!preg_match("/^[0-9]{10}$/", $phoneno)) {
        $status = "Invalid phone number format. It should be a 10-digit number.";
    } else {
        
        $ins_query = "INSERT INTO corporate (`trn_date`, `corporateno`, `name`, `address`, `date`, `phoneno`, `fat_content`, `quantity`)
                      VALUES ('$trn_date', '$corporateno', '$name', '$address', '$date', '$phoneno', '$fat_content', '$quantity')";

        mysqli_query($con, $ins_query) or die(mysqli_error($con));

        $status = "New Record Inserted Successfully.";

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Corporate</title>
    
    <style>
        * {
            box-sizing: border-box;
        }

        html {
            font-size: calc(100% + 0.5vw);
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition-duration: 0.001s !important;
            }
        }

        .form1 {
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            
            background-position: 50% 50%;
            animation: background-move 10s linear infinite;
            background-size: 100vw auto, 100% 100%;
        }


        .container {
            background: linear-gradient(100deg, #402, #006);
            padding: 2em;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 460 55'%3E%3Cg fill='none' fill-rule='evenodd' stroke='%23fff' stroke-width='7' opacity='.1'%3E%3Cpath d='M-345 34.5s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 48.3 0 48.3s115-13.8 115-13.8 57.5-13.8 115-13.8 115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8'/%3E%3Cpath d='M-345 20.7s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 34.5 0 34.5s115-13.8 115-13.8S172.5 6.9 230 6.9s115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8m-920 27.6s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 62.1 0 62.1s115-13.8 115-13.8 57.5-13.8 115-13.8 115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8'/%3E%3Cpath d='M-345 6.9s57.5-13.8 115-13.8S-115 6.9-115 6.9-57.5 20.7 0 20.7 115 6.9 115 6.9 172.5-6.9 230-6.9 345 6.9 345 6.9s57.5 13.8 115 13.8S575 6.9 575 6.9'/%3E%3Cpath d='M-345-6.9s57.5-13.8 115-13.8S-115-6.9-115-6.9-57.5 6.9 0 6.9 115-6.9 115-6.9s57.5-13.8 115-13.8S345-6.9 345-6.9 402.5 6.9 460 6.9 575-6.9 575-6.9m-920 69s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 75.9 0 75.9s115-13.8 115-13.8 57.5-13.8 115-13.8 115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8'/%3E%3C/g%3E%3C/svg%3E%0A"),
                linear-gradient(80deg, #202, #006);
            background-position: 50% 50%;
            animation: background-move 10s linear infinite;
            background-size: 100vw auto, 100% 100%;
            background-size: unquote('max(100vw, 30em)') auto, 100% 100%;
        }


        @keyframes background-move {
            0% {
                background-position: 0 0, 0 0;
            }

            100% {
                background-position: 100vw 0, 0 0;
                background-position: unquote('max(100vw, 40em)') 0, 0 0;
            }
        }

        .input-group {
            width: 100%;
            max-width: 20em;
            z-index: 2;
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #fff;
            font-size: 2em;
            margin-bottom: 20px;
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

            &:hover {
                background-position: 100% 0;
            }

            &:focus {
                outline: 2px dashed #ad2b89;
                outline-offset: 0.5em;
            }
        }

        input[type="submit"] {
            background-color: #006;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;

            &:hover {
                background-color: #004080;
            }
        }

        p {
            color: #FF0000;
            margin: 0;
        }
        .top {
            position: fixed;
            right: 0;
            top: 0;
            width: 100%;
            background-color: black;
            color: white;
            text-align: center;
            z-index: 1000;
        }

        .list {
            float: right;
            margin-right: 40px;
        }

        .list li {
            display: inline-block;
            margin-right: 30px;
            margin-top: 0.6em 1em; 
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
        
    </style>
</head>

<body>

    <div class="top">
        <ul class="list">
            <img id="logo" src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="Logo">
            <li><a href="homepage.php">Home</a></li>
            <li><a href="corporate.php">Corporate Details</a></li>
            <li><a href="corporatesearchprint.php">Bill</a></li>
        </ul>
    </div>
    <div class="container">
        <div class="input-group">
            <h1>Corporate Details</h1>
            <p><?php echo $status; ?></p>
            <div class="form1">
                <form name="form" method="post" action="">
                    <input type="hidden" name="new" value="1" />
                    <label for="corporateno">Corporate No</label>
                    <input type="text" name="corporateno" placeholder="Enter Corporate No" value="<?php echo isset($_POST['corporateno']) ? $_POST['corporateno'] : $_SESSION['corporateno']; ?>" required />
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="Enter Name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $_SESSION['username']; ?>" required />
                    <label for="address">Address</label>
                    <input type="text" name="address" placeholder="Enter Address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>" required />
                    <label for="date">Date</label>
                    <input type="date" name="date" placeholder="Date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>" required />
                    <label for="phoneno">Phone Number</label>
                    <input type="text" name="phoneno" placeholder="Enter Phone Number" value="<?php echo isset($_POST['phoneno']) ? $_POST['phoneno'] : ''; ?>" required />
                    <label for="fat_content">Fat Content</label>
                    <input type="text" name="fat_content" placeholder="Enter Fat Content" value="<?php echo isset($_POST['fat_content']) ? $_POST['fat_content'] : ''; ?>" required />
                    <label for="quantity">Quality of Milk</label>
                    <input type="text" name="quantity" placeholder="Enter Quality of Milk" value="<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : ''; ?>" required />
                    <input type="submit" value="Submit" />
                </form>
            </div>
        </div>
    </div>

</body>

</html>