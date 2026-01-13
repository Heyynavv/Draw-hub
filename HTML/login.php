<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UAE Lottery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>.glass { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }</style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex items-center justify-center p-4">

    <div class="glass w-full max-w-[420px] rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.1)] p-8 md:p-10 border border-white">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black italic uppercase tracking-tighter text-slate-900">Welcome Back</h1>
            <p class="text-slate-400 text-sm font-medium mt-2">Log in to check your tickets!</p>
        </div>

        <form action="login.php" method="POST" class="space-y-6">
            <div class="relative">
                <i class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="email" name="email" placeholder="Email Address" required class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:border-green-500 transition-all">
            </div>
            <div class="relative">
                <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="password" name="password" placeholder="Password" required class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:border-green-500 transition-all">
            </div>
            <button type="submit" name="login" class="w-full bg-slate-900 hover:bg-black text-white font-black py-4 rounded-2xl shadow-lg transition-all active:scale-95 uppercase italic">Sign In</button>
        </form>

        <div class="mt-10 text-center"><p class="text-slate-500 text-sm">New here? <a href="register.html" class="text-green-600 font-bold hover:underline">Create Account</a></p></div>
    </div>
</body>
</html>