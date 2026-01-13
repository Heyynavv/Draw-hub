<?php
session_start();
include '../includes/db.php'; 

if (isset($_POST['mobile'])) {
    $phone = mysqli_real_escape_string($conn, $_POST['mobile']);
    
    // Weekly table se data uthao
    $query = "SELECT * FROM weekly_users WHERE phone = '$phone'"; 
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Weekly session keys
        $_SESSION['weekly_logged_in'] = true;
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['weekly_lottery'] = $user['lottery_number'];

        exit("success");
    } else {
        exit("not_found");
    }
}
?>