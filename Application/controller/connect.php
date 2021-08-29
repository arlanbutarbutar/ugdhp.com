<?php
$conn_front=mysqli_connect("localhost","root","ArlanBB270899","ugdhpcom_frontv28");
if ($conn_front->connect_error) {
    die("Connection failed: " . $conn_front->connect_error);
}
$conn_back=mysqli_connect("localhost","root","ArlanBB270899","db_ugdhp");
if ($conn_back->connect_error) {
    die("Connection failed: " . $conn_back->connect_error);
}