<?php
session_start();
if(!isset($_SESSION['admin'])) { header("Location: index.php"); exit(); }
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAE LOTTERY | MASTER ADMIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { background-color: #f0f4f8; font-family: 'Plus Jakarta Sans', sans-serif; overflow: hidden; }
        
        /* SIDEBAR HOVER FIX */
        .nav-link { 
            color: #64748b !important; 
            transition: all 0.3s ease; 
            font-weight: 700;
        }
        /* Jab hover karein toh bg light grey ho aur text blue rahe (white nahi) */
        .nav-link:hover { 
            background-color: #f1f5f9 !important; 
            color: #2563eb !important; 
            transform: translateX(5px);
        }
        /* Active button hamesha blue bg aur white text rahega */
        .nav-link.active { 
            background: #2563eb !important; 
            color: #ffffff !important; 
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3); 
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float-card { animation: floating 4s ease-in-out infinite; }

        .bg-animate {
            background: linear-gradient(-45deg, #f8fafc, #eff6ff, #f1f5f9, #ffffff);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        #sidebar { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        @media (max-width: 1024px) { #sidebar { transform: translateX(-100%); } #sidebar.open { transform: translateX(0); } }
    </style>
</head>
<body class="bg-animate flex h-screen overflow-hidden">

    <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[90] hidden lg:hidden"></div>

    <aside id="sidebar" class="w-72 bg-white/80 backdrop-blur-xl border-r border-slate-200 flex flex-col shrink-0 lg:relative z-[100] fixed inset-y-0">
        <div class="p-8 flex items-center justify-between">
            <h1 class="text-2xl font-extrabold tracking-tighter text-slate-900 italic">UAE<span class="text-blue-600">LOTTERY</span></h1>
            <button onclick="toggleSidebar()" class="lg:hidden text-slate-400 text-xl hover:text-red-500"><i class="fas fa-times"></i></button>
        </div>
        
        <nav class="flex-1 px-6 space-y-2 overflow-y-auto">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[2px] ml-4 mb-2">Main Menu</p>
            <button onclick="switchTab('stats', this)" class="nav-link active w-full flex items-center p-4 rounded-2xl">
                <i class="fas fa-chart-line mr-3 w-5"></i><span>Overview</span>
            </button>
            <button onclick="switchTab('luckyday', this)" class="nav-link w-full flex items-center p-4 rounded-2xl">
                <i class="fas fa-bolt mr-3 w-5"></i><span>Lucky Day</span>
            </button>
            <button onclick="switchTab('weekly', this)" class="nav-link w-full flex items-center p-4 rounded-2xl">
                <i class="fas fa-calendar-week mr-3 w-5"></i><span>Weekly Draw</span>
            </button>

            <div class="pt-4 mt-4 border-t border-slate-100">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[2px] ml-4 mb-2">Management</p>
                <button class="nav-link w-full flex items-center p-4 rounded-2xl opacity-60 cursor-not-allowed">
                    <i class="fas fa-trophy mr-3 w-5"></i><span>Winners List</span>
                </button>
                <button class="nav-link w-full flex items-center p-4 rounded-2xl opacity-60 cursor-not-allowed">
                    <i class="fas fa-ticket-alt mr-3 w-5"></i><span>Ticket Tools</span>
                </button>
                <button class="nav-link w-full flex items-center p-4 rounded-2xl opacity-60 cursor-not-allowed">
                    <i class="fas fa-cog mr-3 w-5"></i><span>Settings</span>
                </button>
            </div>
        </nav>

        <div class="p-8">
            <a href="logout.php" class="flex items-center text-red-500 font-bold p-4 rounded-2xl hover:bg-red-50 transition-all">
                <i class="fas fa-power-off mr-3"></i>LOGOUT
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-20 lg:h-24 flex items-center justify-between px-6 lg:px-12 bg-white/50 backdrop-blur-md border-b border-slate-200">
    <div class="flex items-center">
        <button onclick="toggleSidebar()" class="lg:hidden mr-4 text-slate-600 text-xl p-2 bg-white rounded-xl shadow-sm border"><i class="fas fa-bars"></i></button>
        <h2 id="headerTitle" class="text-xl lg:text-2xl font-black text-slate-800 tracking-tight uppercase italic">Live Console</h2>
    </div>
    
    <div class="flex items-center space-x-3 lg:space-x-6">
        <button id="clearAllBtn" onclick="clearAllEntries()" class="hidden bg-red-50 text-red-600 px-4 py-2 rounded-xl border border-red-100 font-bold text-xs hover:bg-red-600 hover:text-white transition-all flex items-center">
            <i class="fas fa-broom mr-2"></i> <span class="hidden md:inline">Clear All</span>
        </button>

        <div class="bg-blue-600 px-6 py-2 rounded-full shadow-lg shadow-blue-200 text-white font-black flex items-center">
            <span id="header-count" class="mr-2 text-lg">0</span> <span class="text-[10px] uppercase opacity-80 tracking-widest">Entries</span>
        </div>
    </div>
</header>

        <div class="flex-1 overflow-y-auto p-6 lg:p-12">
            
            <div id="statsSection" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="float-card bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                        <div class="flex justify-between items-start mb-4">
                            <span class="p-3 bg-blue-50 text-blue-600 rounded-2xl"><i class="fas fa-users text-xl"></i></span>
                            <span class="text-xs font-black text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full">LIVE</span>
                        </div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Registrations</p>
                        <h3 id="stat-total" class="text-5xl font-black text-slate-900 mt-2 tracking-tighter">0</h3>
                    </div>
                    
                    <div class="float-card bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50" style="animation-delay: 0.5s">
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-2xl w-fit mb-4"><i class="fas fa-database text-xl"></i></div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Server Status</p>
                        <h3 class="text-2xl font-black text-emerald-500 mt-2 italic">ONLINE</h3>
                    </div>

                    <div class="float-card bg-gradient-to-br from-blue-600 to-blue-800 p-8 rounded-[2.5rem] shadow-xl shadow-blue-300 text-white" style="animation-delay: 1s">
                        <p class="text-xs font-bold text-blue-100 uppercase tracking-widest mb-2">Current Node Time</p>
                        <h3 id="liveTime" class="text-4xl font-black tracking-tighter">00:00:00</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg"><canvas id="userChart" height="180"></canvas></div>
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg flex flex-col items-center">
                        <div class="w-full max-w-[250px]"><canvas id="donutChart"></canvas></div>
                    </div>
                </div>
            </div>

            <div id="tableSection" class="hidden">
                <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-2xl overflow-hidden shadow-slate-200/60">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">
                                <tr>
                                    <th class="p-8">UID</th>
                                    <th class="p-8">Participant Info</th>
                                    <th class="p-8">Lottery ID</th>
                                    <th class="p-8">Entry Timestamp</th>
                                    <th class="p-8 text-center">Operation</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody" class="font-bold text-slate-700"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); document.getElementById('overlay').classList.toggle('hidden'); }
        function updateTime() { document.getElementById('liveTime').innerText = new Date().toLocaleTimeString(); }
        setInterval(updateTime, 1000);

        // Graphs Init
        const userChart = new Chart(document.getElementById('userChart').getContext('2d'), {
            type: 'line',
            data: { labels: ['M','T','W','T','F','S','S'], datasets: [{ data: [30,45,35,60,50,85,95], borderColor: '#2563eb', backgroundColor: 'rgba(37, 99, 235, 0.1)', fill: true, tension: 0.4 }] },
            options: { plugins: { legend: { display: false } }, scales: { y: { display: false }, x: { grid: { display: false } } } }
        });

        const donutChart = new Chart(document.getElementById('donutChart').getContext('2d'), {
            type: 'doughnut',
            data: { labels: ['Lucky','Weekly'], datasets: [{ data: [1,1], backgroundColor: ['#2563eb', '#cbd5e1'], borderWidth: 0 }] },
            options: { cutout: '80%', plugins: { legend: { position: 'bottom' } } }
        });

        function refreshStats() {
            fetch('get_stats.php').then(res => res.json()).then(data => {
                document.getElementById('stat-total').innerText = data.total;
                document.getElementById('header-count').innerText = data.total;
                donutChart.data.datasets[0].data = [data.luckyday, data.weekly];
                donutChart.update();
            });
        }

        function fetchUsers(type) {
            const tbody = document.getElementById('userTableBody');
            tbody.innerHTML = "<tr><td colspan='5' class='p-20 text-center animate-pulse text-slate-300 font-black italic uppercase'>Accessing Database...</td></tr>";
            fetch('fetch_users.php?category=' + type).then(res => res.text()).then(data => {
                tbody.innerHTML = data;
                const count = document.getElementById('current-count-hidden')?.value || 0;
                document.getElementById('header-count').innerText = count;
            });
        }

        function switchTab(type, btn) {
            if(window.innerWidth < 1024) toggleSidebar();
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            btn.classList.add('active');

            if(type === 'stats') {
                document.getElementById('statsSection').classList.remove('hidden');
                document.getElementById('tableSection').classList.add('hidden');
                document.getElementById('headerTitle').innerText = "Live Console";
                refreshStats();
            } else {
                document.getElementById('statsSection').classList.add('hidden');
                document.getElementById('tableSection').classList.remove('hidden');
                document.getElementById('headerTitle').innerText = type.toUpperCase() + " REGISTRY";
                fetchUsers(type);
            }
        }

        function deleteUser(id, type) {
            Swal.fire({
                title: 'PERMANENT PURGE?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                confirmButtonText: 'PURGE',
                cancelButtonText: 'CANCEL'
            }).then((result) => {
                if (result.isConfirmed) {
                    let fd = new FormData();
                    fd.append('id', id);
                    fd.append('category', type);
                    fetch('delete_user.php', { method: 'POST', body: fd }).then(() => { fetchUsers(type); refreshStats(); });
                }
            });
        }
        let currentCategory = 'stats';

function switchTab(type, btn) {
    currentCategory = type; // Current category track rakho
    if(window.innerWidth < 1024) toggleSidebar();
    
    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
    btn.classList.add('active');

    const clearBtn = document.getElementById('clearAllBtn');

    if(type === 'stats') {
        document.getElementById('statsSection').classList.remove('hidden');
        document.getElementById('tableSection').classList.add('hidden');
        document.getElementById('headerTitle').innerText = "Live Console";
        clearBtn.classList.add('hidden'); // Stats par clear button hide
        refreshStats();
    } else {
        document.getElementById('statsSection').classList.add('hidden');
        document.getElementById('tableSection').classList.remove('hidden');
        document.getElementById('headerTitle').innerText = type.toUpperCase() + " REGISTRY";
        clearBtn.classList.remove('hidden'); // Entries par clear button show
        fetchUsers(type);
    }
}

function clearAllEntries() {
    Swal.fire({
        title: 'Danger Zone!',
        text: `Are you sure you want to delete ALL entries from ${currentCategory}? This cannot be undone!`,
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'YES, DELETE EVERYTHING',
        background: '#fff',
    }).then((result) => {
        if (result.isConfirmed) {
            // Second Verification for safety
            Swal.fire({
                title: 'Final Confirmation',
                text: "Type 'DELETE' to confirm",
                input: 'text',
                inputAttributes: { autocapitalize: 'off' },
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if(login !== 'DELETE') {
                        Swal.showValidationMessage('Please type DELETE correctly');
                    }
                }
            }).then((finalResult) => {
                if (finalResult.isConfirmed) {
                    let fd = new FormData();
                    fd.append('category', currentCategory);
                    
                    fetch('clear_all.php', { method: 'POST', body: fd })
                    .then(res => res.text())
                    .then(data => {
                        if(data === 'success') {
                            Swal.fire('Cleaned!', 'All entries have been purged.', 'success');
                            fetchUsers(currentCategory);
                            refreshStats();
                        } else {
                            Swal.fire('Error', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        }
    });
}

        window.onload = () => { refreshStats(); fetchUsers('luckyday'); updateTime(); };
    </script>
</body>
</html>