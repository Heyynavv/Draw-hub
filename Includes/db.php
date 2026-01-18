<?php
$conn = mysqli_connect("localhost", "root", "", "cloned_db");
if (!$conn) { die("Connection Failed: " . mysqli_connect_error()); }
// LIVE SERVER TIMEZONE FIX: 
// Yeh line MySQL ko batayegi ki INDIA (+5:30) ka time use kare
mysqli_query($conn, "SET time_zone = '+05:30'"); 
?>