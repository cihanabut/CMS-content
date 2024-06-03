<?php
include('includes/config.php');
include('includes/database.php');

session_destroy();


header('Location: /cms');
die();