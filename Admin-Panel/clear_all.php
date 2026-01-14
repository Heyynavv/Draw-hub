<?php
session_start();
if(!isset($_SESSION['admin'])) { exit("Unauthorized"); }
include '../includes/db.php';

if(isset($_POST['category'])) {
    $category = $_POST['category'];
    $table = ($category == 'luckyday') ? 'luckyday_users' : 'weekly_users';
    
    // Poori table khaali karne ki query
    $query = "TRUNCATE TABLE $table";
    
    if(mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>