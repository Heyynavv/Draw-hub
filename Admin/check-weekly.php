<?php
session_start();
include '../includes/db.php'; 

// India Timezone Fix
mysqli_query($conn, "SET time_zone = '+05:30'");

if (isset($_POST['mobile'])) {
    $phone = mysqli_real_escape_string($conn, $_POST['mobile']);
    
    // Weekly table se data uthao
    $query = "SELECT * FROM weekly_users WHERE phone = '$phone' LIMIT 1"; 
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Weekly session keys
        $_SESSION['weekly_logged_in'] = true;
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['weekly_lottery'] = $user['lottery_number'];
        
        // --- NEW: Draw Date ko session mein save kiya ---
        $_SESSION['weekly_draw_date'] = $user['draw_date']; 

        exit("success");
    } else {
        exit("not_found");
    }
}
?>