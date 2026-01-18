<?php
session_start();

// 1. Weekly security check
if (!isset($_SESSION['weekly_logged_in']) || $_SESSION['weekly_logged_in'] !== true) {
    header("Location: weekly.php");
    exit();
}

// 2. India Timezone & Session Data
date_default_timezone_set("Asia/Kolkata"); 

$userName = $_SESSION['user_name'];
$userLottery = $_SESSION['weekly_lottery'];

// --- DRAW DATE LOGIC: Registration wali date nikalna ---
if (isset($_SESSION['weekly_draw_date']) && !empty($_SESSION['weekly_draw_date'])) {
    $dbDate = $_SESSION['weekly_draw_date'];
    $liveDay = date("l", strtotime($dbDate)); 
    $liveDate = date("d/m/Y", strtotime($dbDate)); 
} else {
    // Fallback logic
    $liveDay = date("l");
    $liveDate = date("d/m/Y");
}

// 3. One-time view logic
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>UAE LOTTERY | Weekly Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../CSS/results-luckday.css">
</head>
<body>
    <div class="main-wrapper shadow-2xl">
        <div class="header-nav p-4 flex justify-between items-center bg-[#020d20]">
            <div class="flex items-center gap-3">
                <a href="weekly.php" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <div class="border-l border-white/10 pl-3">
                    <p class="text-[7px] text-gray-500 uppercase font-black leading-none mb-1">Registered To</p>
                    <p class="text-[11px] font-bold text-white uppercase tracking-tighter">
                        <?php echo htmlspecialchars($userName); ?>
                    </p>
                </div>
            </div>
            
            <h1 class="text-xs font-black italic uppercase tracking-tighter text-center">UAE <span class="text-yellow-500">Lottery</span></h1>
            
            <div class="text-right">
                <p class="text-[7px] text-gray-400 uppercase font-bold tracking-widest">Draw Date</p>
                <p id="date" class="text-[10px] font-black text-yellow-500">
                    <?php echo "$liveDay, $liveDate"; ?>
                </p>
            </div>
        </div>

        <div class="bg-[#4a0000] py-2 flex justify-center items-center gap-3 border-b border-red-900">
            <span class="text-[9px] font-bold uppercase tracking-widest text-red-200">Next Draw Countdown:</span>
            <span id="timer" class="text-xs timer-box font-mono text-white">23:35:05</span>
        </div>

        <div id="prize-container" class="flex-1 p-5 space-y-10"></div>

        <div class="bg-yellow-500 p-6 space-y-2 mt-auto">
            <div>
                <p class="text-[11px] font-black text-black uppercase mb-3 flex justify-between items-center">
                    <span>Starter Prize</span>
                    <span class="text-black">AED 15000</span>
                </p>
                <div id="starter-grid" class="grid grid-cols-5 gap-2"></div>
            </div>
            <div class="dotted-line my-4 opacity-20 border-t border-black border-dashed"></div>
            <div>
                <p class="text-[11px] font-black text-black uppercase mb-3 flex justify-between items-center">
                    <span>Consolation Prize</span>
                    <span class="text-black">AED 8000</span>
                </p>
                <div id="consolation-grid" class="grid grid-cols-5 gap-2"></div>
            </div>
            <p class="text-center text-[8px] text-black/40 font-bold uppercase pt-8">UAE Official Lottery Portal</p>
        </div>
    </div>
    <script>
        const global_user_lottery = "<?php echo $userLottery; ?>"; 
    </script>
    <script src="../JS/results-weekly.js?v=<?php echo time(); ?>"></script>
</body>
</html>