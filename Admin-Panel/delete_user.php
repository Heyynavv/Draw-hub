<?php
include '../includes/db.php';

if(isset($_POST['id']) && isset($_POST['category'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $category = $_POST['category'];
    
    // Screenshots ke hisaab se table select karna
    $table = ($category == 'luckyday') ? 'luckyday_users' : 'weekly_users';

    // Delete query
    $sql = "DELETE FROM $table WHERE id = '$id'";
    
    if(mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>