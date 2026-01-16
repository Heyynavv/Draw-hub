<?php
session_start();
include __DIR__ . '/../Includes/db.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>UAE LOTTERY | ADMIN LOGIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@900&display=swap');
        body { 
            background-color: #000; 
            font-family: 'Inter', sans-serif;
            /* Mobile address bar fix */
            min-height: 100dvh; 
            margin: 0;
            overflow: hidden;
        }
        .bold-text { letter-spacing: -2px; }
        .input-focus:focus { border-color: #2563eb; box-shadow: 0 0 20px rgba(37, 99, 235, 0.2); }
        
        /* Mobile Specific Padding */
        @media (max-width: 640px) {
            .bold-text { letter-spacing: -1px; }
            h1 { font-size: 3.5rem !important; }
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8 lg:mb-12">
            <h1 class="text-5xl lg:text-7xl font-[900] text-white bold-text uppercase leading-none">
                THE UAE<br><span class="text-blue-600">LOTTERY</span>
            </h1>
            <div class="h-1.5 w-16 bg-blue-600 mx-auto mt-6"></div>
            <p class="text-slate-500 text-[9px] lg:text-[10px] font-black tracking-[4px] lg:tracking-[5px] mt-4 uppercase">Admin Terminal</p>
        </div>

        <form method="POST" class="space-y-4 px-2">
            <?php if(isset($error)) echo "<p class='text-red-500 text-center font-bold text-xs mb-4 animate-pulse'>$error</p>"; ?>
            
            <div class="space-y-3">
                <input type="text" name="username" placeholder="ADMIN USERNAME" 
                    class="w-full bg-[#0a0a0a] border-2 border-[#1a1a1a] p-4 lg:p-5 rounded-none text-white font-bold outline-none input-focus transition-all text-sm uppercase">
                
                <input type="password" name="password" placeholder="PASSWORD" 
                    class="w-full bg-[#0a0a0a] border-2 border-[#1a1a1a] p-4 lg:p-5 rounded-none text-white font-bold outline-none input-focus transition-all text-sm">
            </div>

            <button name="login" class="w-full bg-white text-black font-[900] p-4 lg:p-5 hover:bg-blue-600 hover:text-white transition-all duration-300 uppercase italic tracking-tighter text-lg mt-2">
                Enter Dashboard →
            </button>
        </form>

        <p class="text-center text-[#222] font-black text-[10px] mt-12 uppercase tracking-widest">Secure Encryption Active</p>
    </div>
</body>
</html>