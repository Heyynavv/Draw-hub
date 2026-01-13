<?php
include '../includes/db.php';
if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $phone = $_POST['phone'];
    $l_no = $_POST['lottery_no'];
    $date = $_POST['draw_date'];

    $sql = "INSERT INTO users (name, phone, lottery_number, draw_date) VALUES ('$name', '$phone', '$l_no', '$date')";
    if(mysqli_query($conn, $sql)){
        echo "User Registered Successfully!";
    }
}
?>