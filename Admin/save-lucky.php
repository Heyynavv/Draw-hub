<?php
include '../includes/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['mobile']);
    $draw_date = mysqli_real_escape_string($conn, $_POST['draw_date']);
    $lottery_no = mysqli_real_escape_string($conn, $_POST['lottery_num']);

    // Ab direct luckyday_users table mein insert hoga
    $sql = "INSERT INTO luckyday_users (name, phone, draw_date, lottery_number) 
            VALUES ('$name', '$phone', '$draw_date', '$lottery_no')";

    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>