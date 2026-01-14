<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UAE Lottery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
        .premium-popup { border-radius: 2rem !important; padding: 2rem !important; }
        .premium-title { font-weight: 900 !important; text-transform: uppercase; font-style: italic; letter-spacing: -1px; }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-4 relative">

    <a href="../index.php" class="absolute top-6 left-6 flex items-center gap-2 text-slate-400 hover:text-slate-900 transition-all font-bold text-sm group">
        <div class="w-10 h-10 rounded-full bg-white shadow-sm border border-slate-100 flex items-center justify-center group-hover:shadow-md transition-all">
            <i class="fa-solid fa-chevron-left text-xs"></i>
        </div>
        <span class="hidden md:inline uppercase tracking-widest text-[10px]">Back to Home</span>
    </a>

    <div class="glass w-full max-w-[420px] rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.1)] p-8 md:p-10 border border-white">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black italic uppercase tracking-tighter text-slate-900">Welcome Back</h1>
            <p class="text-slate-400 text-sm font-medium mt-2">Log in to check your tickets!</p>
        </div>

        <form id="dummyLoginForm" class="space-y-6">
            <div class="relative">
                <i class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="email" name="email" placeholder="Email Address" required class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:border-green-500 transition-all">
            </div>
            <div class="relative">
                <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="password" name="password" placeholder="Password" required class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:border-green-500 transition-all">
            </div>
            <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-black py-4 rounded-2xl shadow-lg transition-all active:scale-95 uppercase italic flex items-center justify-center gap-2">
                <span>Sign In</span>
                <i class="fa-solid fa-arrow-right-long text-xs"></i>
            </button>
        </form>

        <div class="mt-10 text-center space-y-4">
            <p class="text-slate-500 text-sm">New here? <a href="#" class="text-green-600 font-bold hover:underline">Create Account</a></p>
            
            <a href="../index.php" class="block text-slate-300 hover:text-slate-500 text-[11px] uppercase tracking-[0.2em] font-black transition-all">
                <i class="fa-solid fa-house mr-1"></i> Exit to Lobby
            </a>
        </div>
    </div>

    <script>
        document.getElementById('dummyLoginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'SYSTEM GLITCH',
                text: 'We are experiencing a temporary synchronization error. Please try again in a few moments.',
                icon: 'error',
                confirmButtonText: 'UNDERSTOOD',
                confirmButtonColor: '#0f172a',
                background: '#ffffff',
                customClass: { popup: 'premium-popup', title: 'premium-title' },
                showClass: { popup: 'animate__animated animate__fadeInUp animate__faster' }
            });
        });
    </script>
</body>
</html>