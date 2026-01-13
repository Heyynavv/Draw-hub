<?php
// Errors hide kar rahe hain taaki JS ko sirf 'success' ya 'not_found' mile
error_reporting(0); 
session_start();

// Database connection
// Path check kar lena agar db.php 'includes' folder mein hai
include '../includes/db.php'; 

if (isset($_POST['mobile'])) {
    // Mobile number ko clean kar rahe hain
    $phone = mysqli_real_escape_string($conn, $_POST['mobile']);

    // 1. Sahi Table Name 'luckyday_users' use kiya hai
    // 2. Query check kar rahi hai ki phone registered hai ya nahi
    $query = "SELECT * FROM luckyday_users WHERE phone = '$phone'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Session mein data save kar rahe hain
        $_SESSION['logged_in'] = true;
        $_SESSION['user_name'] = $user['name'];
        
        // Yahan 'user_lottery' use kiya hai kyunki results page pe yahi key chahiye
        $_SESSION['user_lottery'] = $user['lottery_number'];

        // Sirf success bhej rahe hain bina kisi extra space ke
        exit("success");
    } else {
        // Agar number database mein nahi mila
        exit("not_found");
    }
} else {
    exit("no_data_received");
}
?>