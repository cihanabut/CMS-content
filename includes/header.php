<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="css/styles.css"/>

</head>
<body>
<div class="nav">
  <div class="navLogo">
    <img src="img/cms.png" alt="logo-cms" height="80px">
  </div>
  <div class="navItemContainer">
    <a class="navItem" href="/cms/">Home</a>
    <a class="navItem" href="dashboard.php">Dashboard</a>
    <a class="navItem" href="logout.php">Logout</a>
  </div>
  <div class="bMenu">
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
  </div>
</div>

<?php get_message(); ?>

