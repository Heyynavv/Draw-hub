<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAE LOTTERY | Check Prize</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #062214; color: white; overflow-x: hidden; font-family: 'Inter', sans-serif; }
        
        .premium-bg {
            background: radial-gradient(circle at top right, #0a3d25 0%, #062214 100%);
        }

        .glass-box {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .input-dark {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }

        .input-dark:focus {
            border-color: #22c55e;
            background: rgba(34, 197, 94, 0.05);
            box-shadow: 0 0 15px rgba(34, 197, 94, 0.2);
        }

        /* Mobile Placeholder & Padding Fix */
        @media (max-width: 480px) {
            .input-dark { 
                padding-left: 3.8rem !important; 
                font-size: 14px !important;
                letter-spacing: normal !important; 
            }
            .input-dark:not(:placeholder-shown) {
                letter-spacing: 0.15em !important; 
            }
            .country-code { 
                left: 0.8rem !important; 
                font-size: 14px !important;
            }
            .glass-box { padding: 2.5rem 1.25rem !important; }
        }

        .shimmer-btn {
            position: relative;
            overflow: hidden;
        }

        .shimmer-btn::after {
            content: '';
            position: absolute;
            top: -50%; left: -50%; width: 200%; height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }
    </style>
</head>
<body class="premium-bg min-h-screen flex items-center justify-center p-4">

    <a href="../index.php" class="absolute top-6 left-6 text-gray-500 hover:text-green-500 transition-all flex items-center gap-2 text-[10px] font-black uppercase tracking-widest">
        <i class="fa fa-chevron-left"></i> BACK
    </a>

    <div class="glass-box w-full max-w-[420px] rounded-[2.5rem] p-10 md:p-14 text-center">
        
        <div class="flex justify-center mb-6">
            <svg width="50" height="40" viewBox="0 0 60 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="28" y="2" width="2" height="40" fill="#22c55e" rx="1"/>
                <path d="M22 6L14 10V34L22 38V6Z" stroke="#22c55e" stroke-width="2" stroke-linejoin="round"/>
                <path d="M36 6L44 10V34L36 38V6Z" stroke="#22c55e" stroke-width="2" stroke-linejoin="round"/>
            </svg>
        </div>

        <h1 class="text-white text-3xl font-black italic tracking-tighter uppercase mb-4">
            UAE <span class="text-green-500">LOTTERY</span>
        </h1>
        
        <p class="text-gray-300 text-sm md:text-base font-semibold mb-10 leading-snug">
            Enter Your Mobile Number to <br class="md:hidden"> Check Your Weekly Prize
        </p>

        <form id="verifyForm" class="space-y-6 text-left">
            <div class="relative">
                <div class="relative group">
                    <span class="country-code absolute left-6 top-1/2 -translate-y-1/2 text-white font-bold border-r border-white/10 pr-4">+91</span>
                    <input type="tel" id="mobileNumber" 
                        placeholder="Enter Mobile Number" 
                        maxlength="10"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        required
                        class="w-full pl-24 pr-4 py-5 input-dark rounded-2xl text-sm font-bold outline-none">
                </div>
            </div>

            <button type="submit" 
                class="shimmer-btn w-full bg-green-600 hover:bg-green-500 text-white py-5 rounded-2xl font-black uppercase text-xs tracking-[0.2em] shadow-lg flex items-center justify-center gap-3 transition-all active:scale-95">
                CHECK YOUR RESULT
            </button>
        </form>

        <div class="mt-10 pt-6 border-t border-white/5">
            <p class="text-gray-500 text-[10px] font-black tracking-widest uppercase">
                Registered Users Only
            </p>
        </div>
    </div>

    <div id="errorPopup" class="fixed inset-0 z-[5000] hidden items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" onclick="closeError()"></div>
        <div class="relative bg-[#0a2015] border border-white/10 w-full max-w-[340px] rounded-[2.5rem] p-10 text-center shadow-3xl">
            <div class="w-20 h-20 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 border border-red-500/20">
                <i class="fa fa-lock text-3xl"></i>
            </div>
            <h3 class="text-white text-lg font-black uppercase tracking-tighter">Access Denied</h3>
            <p class="text-gray-500 text-[11px] mt-3 uppercase tracking-widest leading-relaxed">This number is not registered</p>
            <button onclick="closeError()" class="mt-8 w-full py-4 bg-white text-black rounded-xl font-black uppercase text-[10px] tracking-widest transition-all">Dismiss</button>
        </div>
    </div>

    <script>
    document.getElementById('verifyForm').onsubmit = function(e) {
    e.preventDefault();
    
    const num = document.getElementById('mobileNumber').value;
    
    if(num.length === 10) {
        let formData = new FormData();
        formData.append('mobile', num);

        // '../' ka matlab hai HTML folder se bahar nikal kar Admin folder mein jao
        fetch('../Admin/check-weekly.php', { 
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            console.log("Response from Server:", data); // Debugging ke liye
            const result = data.trim();
            
            if(result === "success") {
                // Number mil gaya, ab result page par bhej do
                window.location.href = 'results-weekly.php'; 
            } else {
                // Agar data "not_found" ya kuch aur aaya
                alert("Access Denied: Your number " + num + " is not registered for Lucky Day!");
            }
        })
        .catch(err => {
            console.error("Fetch Error:", err);
            alert("Technical Error: File path correctly set nahi hai.");
        });
    } else {
        alert("Please enter a valid 10-digit mobile number.");
    }
};
   </script>
</body>
</html>