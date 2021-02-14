<?php
// Connection with Server
$conn = mysqli_connect("localhost","root","") or die("Unable to connect with server. please check credentials"); 

// Selection of Database
mysqli_select_db($conn,"batch_62_phpbasics") or die("Unable to select Database. Please contact Database Admin"); 

?>