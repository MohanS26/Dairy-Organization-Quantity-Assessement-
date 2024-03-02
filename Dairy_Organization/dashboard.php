<?php
include("auth.php");
require('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Organization</title>
<style>
body {
  font: 16px/1.3 "Serif", sans-serif;
    background: linear-gradient(to bottom, #3494e6, #ec6ead); /* Gradient background */
    margin: 0;
  
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
  font-size: 22px;
  color: white;
  font-family: serif;
  font-weight: bold;
}

.list li:hover {
  border-bottom: 4px solid yellow;
  transition: .3s;
}

.main-body {
  margin-top: 150px; 
  text-align: center;
}

#welcome-message {
  font-size: 40px;
  background: linear-gradient(to right, rgba(3, 107, 30, 0.736), rgba(215, 218, 4, 0.681));
  color: #f1f1f1;
  font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}

.column {
  display: inline-block;
  width: 30%;
  margin: 0 15px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 6px;
  text-align: center;
  background-color: #f1f1f1;
  border: 2px solid black;
  margin-bottom: 20px;
}

.card img {
  height: 135px;
}

#t1 {
  font-size: 30px;
  color: black;
  font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}

.card:hover {
  opacity: 0.5;
  transition: 0.3s;
}

.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: black;
  color: white;
  text-align: center;
  padding: 10px;
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
      <li><a href="homepage.php">Home</a></li>
      <li><a href="searchfarmerid.php">Search Farmers</a></li>
      <li><a href="searchcorporateid.php">Search Corporate</a></li>
      <li><a href="salescollection.php">Sales Collection</a></li>
    </ul>
  </div>

  <div class="main-body">
    <div class="form">
      <p id="welcome-message">NatureOne Dairy Management</p>

      <a href="farmersview.php">
    <div class="column">
        <div class="card">
            <img src="img/11.1.jpg" height="300px">
            <p id="t1">Farmers Record</p>
        </div>
    </div>
</a>


      <a href="corporateview.php">
        <div class="column">
          <div class="card">
            <img src="img/staff.png" height="100px">
            <p id="t1">Corporate Record</p>
          </div>
        </div>
      </a>
    </div>
  </div>

  <div class="footer">
   
  </div>
</body>
</html>