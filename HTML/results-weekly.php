<?php
session_start();

// Weekly security check
if (!isset($_SESSION['weekly_logged_in']) || $_SESSION['weekly_logged_in'] !== true) {
    header("Location: weekly.php");
    exit();
}

$userName = $_SESSION['user_name'];
$userLottery = $_SESSION['weekly_lottery'];

// One-time view logic (Refresh par expire ho jaye)
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>UAE LOTTERY | Lucky Day Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../CSS/results-luckday.css">
    <style>
        .my-ticket-badge {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid rgba(234, 179, 8, 0.3);
        }
    </style>
</head>
<body>

    <div class="main-wrapper shadow-2xl">
        <div class="header-nav p-4 flex justify-between items-center bg-[#020d20]">
            <div class="flex items-center gap-3">
                <a href="weekly.php" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <div class="border-l border-white/10 pl-3">
                    <p class="text-[7px] text-gray-500 uppercase font-black tracking-[0.2em] leading-none mb-1">Registered To</p>
                    <p class="text-[11px] font-bold text-white uppercase tracking-tighter">
                        <?php echo htmlspecialchars($userName); ?>
                    </p>
                </div>
            </div>
            
            <h1 class="text-xs font-black italic uppercase tracking-tighter text-center">UAE <span class="text-yellow-500">Lottery</span></h1>
            
            <div class="text-right">
                <p class="text-[7px] text-gray-400 uppercase font-bold tracking-widest">Draw Date</p>
                <p id="date" class="text-[10px] font-black text-yellow-500">Loading...</p>
            </div>
        </div>

        <div class="bg-[#4a0000] py-2 flex justify-center items-center gap-3 border-b border-red-900">
            <span class="text-[9px] font-bold uppercase tracking-widest text-red-200">Next Draw Countdown:</span>
            <span id="timer" class="text-xs timer-box font-mono">23:35:05</span>
        </div>

        <!-- <div class="px-5 pt-6">
            <div class="my-ticket-badge rounded-2xl p-4 text-center shadow-lg">
                <p class="text-[8px] font-black text-yellow-500/70 uppercase tracking-[0.3em] mb-2">Your Registered Ticket</p>
                <h2 class="text-3xl font-black text-white tracking-[12px] italic underline decoration-yellow-500 decoration-4 underline-offset-8">
                    <?php echo htmlspecialchars($userLottery); ?>
                </h2>
            </div>
        </div> -->

        <div id="prize-container" class="flex-1 p-5 space-y-10">
            </div>

        <div class="bg-yellow-500 p-6 space-y-2 shadow-[0_-15px_30px_rgba(0,0,0,0.5)] mt-auto">
            <div>
                <p class="text-[11px] font-black text-black uppercase mb-3 tracking-tighter">Starter Prize</p>
                <div id="starter-grid" class="grid grid-cols-5 gap-2"></div>
            </div>

            <div class="dotted-line my-4 opacity-20"></div>

            <div>
                <p class="text-[11px] font-black text-black uppercase mb-3 tracking-tighter">Consolation Prize</p>
                <div id="consolation-grid" class="grid grid-cols-5 gap-2"></div>
            </div>

            <p class="text-center text-[8px] text-black/40 font-bold uppercase tracking-[0.3em] pt-8">UAE Official Lottery Portal</p>
        </div>
    </div>
    <script>
    // PHP se number JS ko dena
    const global_user_lottery = "<?php echo $userLottery; ?>"; 
</script>

<script src="../JS/results-weekly.js?v=1.1"></script>
</html>