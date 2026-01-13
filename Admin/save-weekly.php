<?php
include '../includes/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['mobile']);
    $draw_date = mysqli_real_escape_string($conn, $_POST['draw_date']);
    $lottery_no = mysqli_real_escape_string($conn, $_POST['lottery_num']);

    // Check Duplicate for Weekly only
    $check = "SELECT id FROM weekly_users WHERE phone = '$phone'";
    $res = mysqli_query($conn, $check);

    if(mysqli_num_rows($res) > 0) {
        echo "exists";
    } else {
        // Insert into weekly_users table
        $sql = "INSERT INTO weekly_users (name, phone, draw_date, lottery_number) 
                VALUES ('$name', '$phone', '$draw_date', '$lottery_no')";

        if (mysqli_query($conn, $sql)) {
            echo "success";
        } else {
            echo "error: " . mysqli_error($conn);
        }
    }
}
?>