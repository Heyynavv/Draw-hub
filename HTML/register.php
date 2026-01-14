<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join UAE Lottery | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .glass { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
        
        /* Premium Alert Styling */
        .premium-popup { border-radius: 2rem !important; padding: 2rem !important; }
        .premium-title { font-weight: 900 !important; text-transform: uppercase; font-style: italic; letter-spacing: -1px; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <a href="../index.php" class="absolute top-6 left-6 z-50 flex items-center gap-2 text-slate-400 hover:text-slate-900 transition-all font-bold text-sm group">
        <div class="w-10 h-10 rounded-full bg-white shadow-sm border border-slate-100 flex items-center justify-center group-hover:shadow-md transition-all">
            <i class="fa-solid fa-chevron-left text-xs"></i>
        </div>
        <span class="hidden md:inline uppercase tracking-widest text-[10px]">Back to Home</span>
    </a>

    <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-green-100 rounded-full blur-3xl opacity-50 animate-float"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-100 rounded-full blur-3xl opacity-50 animate-float" style="animation-delay: 2s;"></div>
    </div>

    <div class="glass w-full max-w-[450px] rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.1)] p-8 md:p-10 border border-white">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black italic uppercase tracking-tighter text-slate-900">Create Account</h1>
            <p class="text-slate-400 text-sm font-medium mt-2">Join the lucky winners today!</p>
        </div>

        <form id="dummyRegisterForm" class="space-y-5">
            <div class="relative">
                <i class="fa fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="fullname" placeholder="Full Name" required class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:border-green-500 transition-all">
            </div>
            <div class="relative">
                <i class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="email" name="email" placeholder="Email Address" required class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:border-green-500 transition-all">
            </div>
            <div class="relative">
                <i class="fa fa-ticket absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="lottery_number" placeholder="Preferred Lottery Number" class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:border-green-500 transition-all">
            </div>
            <div class="relative">
                <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="password" name="password" placeholder="Password" required class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:border-green-500 transition-all">
            </div>
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-4 rounded-2xl shadow-lg transition-all active:scale-95 uppercase italic flex items-center justify-center gap-2">
                <span>Register Now</span>
                <i class="fa-solid fa-paper-plane text-xs"></i>
            </button>
        </form>

        <div class="mt-8 text-center space-y-4">
            <p class="text-slate-500 text-sm">Already have an account? <a href="login.php" class="text-green-600 font-bold hover:underline">Login</a></p>
            
            <a href="../index.php" class="block text-slate-300 hover:text-slate-500 text-[11px] uppercase tracking-[0.2em] font-black transition-all">
                <i class="fa-solid fa-house mr-1"></i> Exit to Lobby
            </a>
        </div>
    </div>

    <script>
        document.getElementById('dummyRegisterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Premium Glitch Alert for Registration
            Swal.fire({
                title: 'SYNC ERROR',
                text: 'Account database is currently under maintenance. Your registration cannot be processed at this time.',
                icon: 'error',
                confirmButtonText: 'TRY LATER',
                confirmButtonColor: '#16a34a',
                background: '#ffffff',
                customClass: {
                    popup: 'premium-popup',
                    title: 'premium-title'
                },
                showClass: {
                    popup: 'animate__animated animate__fadeInUp animate__faster'
                }
            });
        });
    </script>
</body>
</html>