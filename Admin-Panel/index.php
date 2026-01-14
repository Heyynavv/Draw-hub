<?php
session_start();
include '../includes/db.php';

if(isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = $_POST['password']; 
    $res = mysqli_query($conn, "SELECT * FROM admins WHERE username='$user' AND password='$pass'");
    if(mysqli_num_rows($res) > 0) {
        $_SESSION['admin'] = $user;
        header("Location: dashboard.php");
    } else { $error = "INVALID ACCESS!"; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@900&display=swap');
        body { background-color: #000; font-family: 'Inter', sans-serif; }
        .bold-text { letter-spacing: -2px; }
        .input-focus:focus { border-color: #fff; box-shadow: 0 0 20px rgba(255,255,255,0.1); }
    </style>
</head>
<body class="flex items-center justify-center h-screen">
    <div class="w-full max-w-md p-8">
        <div class="text-center mb-12">
            <h1 class="text-6xl font-[900] text-white bold-text uppercase leading-none">UAE<br><span class="text-blue-600">LOTTERY</span></h1>
            <div class="h-1 w-20 bg-blue-600 mx-auto mt-4"></div>
            <p class="text-slate-500 text-[10px] font-black tracking-[5px] mt-4 uppercase">Admin Terminal</p>
        </div>

        <form method="POST" class="space-y-4">
            <?php if(isset($error)) echo "<p class='text-red-600 text-center font-bold text-xs mb-4'>$error</p>"; ?>
            <input type="text" name="username" placeholder="ADMIN USERNAME" class="w-full bg-[#111] border-2 border-[#222] p-5 rounded-none text-white font-bold outline-none input-focus transition-all text-sm">
            <input type="password" name="password" placeholder="SECRET PASSWORD" class="w-full bg-[#111] border-2 border-[#222] p-5 rounded-none text-white font-bold outline-none input-focus transition-all text-sm">
            <button name="login" class="w-full bg-white text-black font-[900] p-5 hover:bg-blue-600 hover:text-white transition-all duration-500 uppercase italic tracking-tighter">Enter Dashboard →</button>
        </form>
    </div>
</body>
</html>