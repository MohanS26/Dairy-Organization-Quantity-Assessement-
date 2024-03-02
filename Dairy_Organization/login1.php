<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
       body {
    font-family: 'Arial Narrow Bold', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #9f0;
    background-image: url(img/15.jpg);
}


.top {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: black;
            color: white;       
        }

.list {
    float: right;
    margin-right: 40px;
}

.list li {
    display: inline-block;
    margin-right: 20px;
    border: 2px solid transparent;
    padding: 5px 10px; 
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
    max-width: 15em;
    background: rgba(255, 255, 255, 0.2);
    padding: 60px; 
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center; 
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
    font-family: 'Times New Roman', Times, serif;
    font-size: 0.90rem;
    line-height: 1;
    border: 0.25em solid transparent;
    background-image: linear-gradient(#000, #000), linear-gradient(120deg, #f09 0%, #0ff 50%, #9f0 100%);
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
    padding:0.8em 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #004080;
}

.message-container {
    color: red;
    text-align: center;
    margin-top: 10px; 
}


    </style>
    
    <script>
        function validateForm() {
            var username = document.forms["login"]["username"].value;
            var password = document.forms["login"]["password"].value;

            if (username === null || username === "") {
                alert("Username can't be blank");
                return false;
            }

           
            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            } else if (password.length > 16) {
                alert("Password must not exceed 16 characters.");
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

<?php
require('db.php');

$loginError = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con, $password);

    
    $adminUsername = "Admin";
    $adminPassword = md5("Admin12@");

    if ($username == $adminUsername && md5($password) == $adminPassword) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $loginError = " username/password is incorrect.";
    }
}
?>

<body>

<div class="top">
    <ul class="list">
        <li><a href="Homepage.php">Home</a></li>
        <li><a href='registration1.php'>Registration</a></li>
    </ul>
</div>



<div class="input-group">
    <h1>Log In</h1>

    <form action="" method="post" name="login" onsubmit="return validateForm()">
        <input type="text" name="username" placeholder="Username" />
        <input type="password" name="password" placeholder="Password" required />
        <input name="submit" type="submit" />
    </form>

    <?php if (!empty($loginError)) { ?>
        <div class="message-container">
            <h3><?php echo $loginError; ?></h3>
        </div>
    <?php } ?>

</div>
</body>
</html>