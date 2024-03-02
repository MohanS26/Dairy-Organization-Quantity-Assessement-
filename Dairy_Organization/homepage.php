<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dairy Management</title>
    <style>
       
body, h1, h2, p, ul {
    margin: 0;
    padding: 0;
}
body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif !important;
            background-image: url('img/IMG-20240108-WA0016.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .header {
            position: fixed;
            right: 0;
            top: 0;
            width: 100%;
            background-color: black;
            color: white;
            text-align: right;
            padding: 10px;
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

        .list li#home a,
        .list li#logout a {
            background: none;
            border: none;
            padding: 0;
        }

        #main_area {
            display: flex;
            align-items: center;
            height: 70vh;
        }

        #welcome-title {
            font-size: 36px;
            color: black;
            font-weight: bolder;
            text-align: center;
            margin-top: 50px;
            border-bottom: 2px solid #fff;
            padding-bottom: 25px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            background-color: lightgreen;
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

        .form-box {
            flex: 1;
            margin: 10px;
        }

        .card {
            position: relative;
            max-width: 250px;
            height: auto;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            margin: 0 auto;
            padding: 20px 20px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, .1);
            transition: .5s;
        }

        .card:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .2);
        }

        .card:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0%;
            background: rgba(255, 255, 255, .1);
            z-index: 1;
            transform: skewY(-5deg) scale(1.5);
        }

        .title .fa {
            color: #fff;
            font-size: 60px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            text-align: center;
            line-height: 100px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, .1);
        }

        .price h3 {
            margin: 0;
            padding: 20px 0;
            text-align: center;
            color: black;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size: 36px;
        }

        .card a {
            position: relative;
            z-index: 2;
            background: #fff;
            color: black;
            width: 150px;
            height: 40px;
            line-height: 40px;
            border-radius: 40px;
            display: block;
            text-align: center;
            margin: 20px auto 0;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            text-decoration: none;
            overflow: hidden;
        }

        .card a:hover::before {
            transform: scaleX(1);
        }

        .button-content {
            position: relative;
            z-index: 1;
        }

        .card a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            transform: scaleX(0);
            transform-origin: 0 50%;
            width: 100%;
            height: inherit;
            border-radius: inherit;
            background: linear-gradient(
                82.3deg,
                rgb(250, 74, 5) 10.8%,
                rgba(99, 88, 238, 1) 94.3%
            );
            transition: all 0.475s;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="header">
        <ul class="list">
            <li id="home"><a href="Homepage.php">Home</a></li>
            <li id="logout"><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div id="welcome-title">
        <img id="logo" src="img/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="Logo">
    Nature One Dairy Management
    </div>
    <section id="main_area">
        <div class="form-box" id="farmers-form">
            <div class="card farmers-card">
                <div class="title">
                    <i class="fa fa-icon"></i>
                </div>
                <div class="price">
                    <h3>Farmers <br>Form</h3>
                </div>
                <a class="button" href="login.php"><span class="button-content"><b>Click here</b></span></a>
            </div>
        </div>
        <div class="form-box" id="organization-form">
            <div class="card organization-card">
                <div class="title">
                    <i class="fa fa-icon"></i>
                </div>
                <div class="price">
                    <h3>Organization Form</h3>
                </div>
                <a class="button" href="login1.php"><span class="button-content"><b>Click here</b></span></a>
            </div>
        </div>
        <div class="form-box" id="corporate-form">
            <div class="card corporate-card">
                <div class="title">
                    <i class="fa fa-icon"></i>
                </div>
                <div class="price">
                    <h3>Corporate<br> Form</h3>
                </div>
                <a class="button" href="login2.php"><span class="button-content"><b>Click here</b></span></a>
            </div>
        </div>
    </section>
</body>

</html>