<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join UAE Lottery | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .glass { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-green-100 rounded-full blur-3xl opacity-50 animate-float"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-100 rounded-full blur-3xl opacity-50 animate-float" style="animation-delay: 2s;"></div>
    </div>

    <div class="glass w-full max-w-[450px] rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.1)] p-8 md:p-10 border border-white">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black italic uppercase tracking-tighter text-slate-900">Create Account</h1>
            <p class="text-slate-400 text-sm font-medium mt-2">Join the lucky winners today!</p>
        </div>

        <form action="register.php" method="POST" class="space-y-5">
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
            <button type="submit" name="register" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-4 rounded-2xl shadow-lg transition-all active:scale-95 uppercase italic">Register Now</button>
        </form>

        <div class="mt-8 text-center"><p class="text-slate-500 text-sm">Already have an account? <a href="login.html" class="text-green-600 font-bold hover:underline">Login</a></p></div>
    </div>
</body>
</html>