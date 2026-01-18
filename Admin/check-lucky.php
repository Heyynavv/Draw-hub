<?php
error_reporting(0); 
session_start();

include '../includes/db.php'; 

// India Timezone Fix
mysqli_query($conn, "SET time_zone = '+05:30'");

if (isset($_POST['mobile'])) {
    $phone = mysqli_real_escape_string($conn, $_POST['mobile']);

    $query = "SELECT * FROM luckyday_users WHERE phone = '$phone' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        $_SESSION['logged_in'] = true;
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_lottery'] = $user['lottery_number'];
        
        // --- NEW LINE: Database wali draw date session mein save ki ---
        $_SESSION['draw_date'] = $user['draw_date']; 

        exit("success");
    } else {
        exit("not_found");
    }
} else {
    exit("no_data_received");
}
?>