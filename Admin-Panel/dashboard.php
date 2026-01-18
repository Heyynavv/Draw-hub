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
        .nav-link { color: #64748b !important; transition: all 0.3s ease; font-weight: 700; }
        .nav-link:hover { background-color: #f1f5f9 !important; color: #2563eb !important; transform: translateX(5px); }
        .nav-link.active { background: #2563eb !important; color: #ffffff !important; box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3); }
        @keyframes floating { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
        .float-card { animation: floating 4s ease-in-out infinite; }
        .bg-animate { background: linear-gradient(-45deg, #f8fafc, #eff6ff, #f1f5f9, #ffffff); background-size: 400% 400%; animation: gradient 15s ease infinite; }
        @keyframes gradient { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        #sidebar { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        @media (max-width: 1024px) { #sidebar { transform: translateX(-100%); } #sidebar.open { transform: translateX(0); } }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
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
            <button onclick="switchTab('stats', this)" class="nav-link active w-full flex items-center p-4 rounded-2xl text-left">
                <i class="fas fa-chart-line mr-3 w-5"></i><span>Overview</span>
            </button>
            <button onclick="switchTab('luckyday', this)" class="nav-link w-full flex items-center p-4 rounded-2xl text-left">
                <i class="fas fa-bolt mr-3 w-5"></i><span>Lucky Day</span>
            </button>
            <button onclick="switchTab('weekly', this)" class="nav-link w-full flex items-center p-4 rounded-2xl text-left">
                <i class="fas fa-calendar-week mr-3 w-5"></i><span>Weekly</span>
            </button>
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
                    <i class="fas fa-trash-can mr-2"></i> <span class="hidden md:inline">Delete All</span>
                </button>
                <div class="bg-blue-600 px-6 py-2 rounded-full shadow-lg text-white font-black flex items-center">
                    <span id="header-count" class="mr-2 text-lg">0</span> <span class="text-[10px] uppercase opacity-80 tracking-widest">Entries</span>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 lg:p-12">
            
            <div id="statsSection" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div onclick="switchTab('luckyday', null)" class="float-card cursor-pointer bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-blue-500 transition-all">
                        <div class="flex justify-between items-start mb-4">
                            <span class="p-3 bg-cyan-50 text-cyan-600 rounded-2xl"><i class="fas fa-bolt text-xl"></i></span>
                            <span class="text-[10px] font-black text-cyan-600 bg-cyan-50 px-3 py-1 rounded-full uppercase">Lucky Day</span>
                        </div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Entries</p>
                        <h3 id="stat-lucky" class="text-5xl font-black text-slate-900 mt-2 tracking-tighter">0</h3>
                    </div>

                    <div onclick="switchTab('weekly', null)" class="float-card cursor-pointer bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-indigo-500 transition-all" style="animation-delay: 0.2s">
                        <div class="flex justify-between items-start mb-4">
                            <span class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl"><i class="fas fa-calendar-week text-xl"></i></span>
                            <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full uppercase">Weekly</span>
                        </div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Entries</p>
                        <h3 id="stat-weekly" class="text-5xl font-black text-slate-900 mt-2 tracking-tighter">0</h3>
                    </div>

                    <div class="float-card bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50" style="animation-delay: 0.4s">
                        <div class="flex justify-between items-start mb-4">
                            <span class="p-3 bg-blue-50 text-blue-600 rounded-2xl"><i class="fas fa-users text-xl"></i></span>
                            <span class="text-xs font-black text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full uppercase">Live</span>
                        </div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Global Registrations</p>
                        <h3 id="stat-total" class="text-5xl font-black text-slate-900 mt-2 tracking-tighter">0</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg"><canvas id="userChart" height="180"></canvas></div>
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg flex flex-col items-center justify-center">
                        <div class="w-full max-w-[250px]"><canvas id="donutChart"></canvas></div>
                    </div>
                </div>
            </div>

            <div id="tableSection" class="hidden space-y-6">
                <div class="relative w-full max-w-md">
                    <i class="fas fa-search absolute left-6 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" id="searchInput" onkeyup="searchData()" placeholder="Search Name or ID..." class="w-full pl-14 pr-6 py-4 bg-white border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all font-bold">
                </div>
                <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-2xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">
                                <tr>
                                    <th class="p-8">UID</th>
                                    <th class="p-8">Participant Info</th>
                                    <th class="p-8">Lottery ID</th>
                                    <th class="p-8">Reg. Time</th> 
                                    <th class="p-8">Draw Date</th> 
                                    <th class="p-8 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody" class="font-bold text-slate-700"></tbody>
                        </table>
                    </div>
                </div>
                <div id="paginationContainer" class="flex justify-center items-center gap-2 py-4"></div>
            </div>
        </div>
    </main>

    <script>
        let currentCategory = 'stats';
        let currentPage = 1;
        let searchQuery = "";
        let autoRefreshInterval; // For live polling

        function toggleSidebar() { 
            document.getElementById('sidebar').classList.toggle('open'); 
            document.getElementById('overlay').classList.toggle('hidden'); 
        }
        
        // Charts Initializations
        const userChart = new Chart(document.getElementById('userChart').getContext('2d'), {
            type: 'line',
            data: { 
                labels: ['M','T','W','T','F','S','S'], 
                datasets: [{ 
                    data: [30,45,35,60,50,85,95], 
                    borderColor: '#2563eb', 
                    backgroundColor: 'rgba(37, 99, 235, 0.1)', 
                    fill: true, 
                    tension: 0.4 
                }] 
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { display: false }, x: { grid: { display: false } } } }
        });

        const donutChart = new Chart(document.getElementById('donutChart').getContext('2d'), {
            type: 'doughnut',
            data: { 
                labels: ['Lucky Day','Weekly'], 
                datasets: [{ data: [1,1], backgroundColor: ['#06b6d4', '#6366f1'], borderWidth: 0 }] 
            },
            options: { cutout: '80%', plugins: { legend: { position: 'bottom' } } }
        });

        function refreshStats() {
            fetch('get_stats.php').then(res => res.json()).then(data => {
                document.getElementById('stat-total').innerText = data.total;
                document.getElementById('stat-lucky').innerText = data.luckyday;
                document.getElementById('stat-weekly').innerText = data.weekly;
                donutChart.data.datasets[0].data = [data.luckyday, data.weekly];
                donutChart.update();
            });
        }

        // Live Auto-Refresh Logic
        function startAutoRefresh() {
            if(autoRefreshInterval) clearInterval(autoRefreshInterval);
            autoRefreshInterval = setInterval(() => {
                // Sirf tabhi refresh ho jab user search na kar raha ho (prevent flickering)
                if(document.getElementById('searchInput').value === "") {
                    refreshStats();
                    if(currentCategory !== 'stats') {
                        fetchUsers(currentCategory, currentPage, true); // true means silent refresh
                    }
                }
            }, 5000); // 5 Seconds
        }

        function fetchUsers(type, page = 1, silent = false) {
            currentCategory = type;
            currentPage = page;
            const tbody = document.getElementById('userTableBody');
            
            // "Silent" refresh mein searching msg nahi dikhayenge
            if(!silent) {
                tbody.innerHTML = "<tr><td colspan='6' class='p-20 text-center animate-pulse text-slate-300 font-black italic uppercase'>Searching...</td></tr>";
            }
            
            fetch(`fetch_users.php?category=${type}&page=${page}&search=${searchQuery}&v=${Date.now()}`)
            .then(res => res.text()).then(data => {
                tbody.innerHTML = data;
                renderPagination();
                const currentCount = document.getElementById('currentCountHidden')?.value || 0;
                document.getElementById('header-count').innerText = currentCount;
            });
        }

        function renderPagination() {
            const totalPages = parseInt(document.getElementById('totalPagesHidden')?.value || 0);
            const container = document.getElementById('paginationContainer');
            container.innerHTML = "";
            if(totalPages <= 1) return;
            for (let i = 1; i <= totalPages; i++) {
                const activeClass = (i === currentPage) ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-slate-500 border border-slate-200';
                container.innerHTML += `<button onclick="fetchUsers(currentCategory, ${i})" class="w-10 h-10 rounded-xl font-bold transition-all ${activeClass}">${i}</button>`;
            }
        }

        function searchData() { 
            searchQuery = document.getElementById('searchInput').value; 
            fetchUsers(currentCategory, 1); 
        }

        function switchTab(type, btn) {
            currentCategory = type;
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            
            if(btn) {
                btn.classList.add('active');
                if(window.innerWidth < 1024) toggleSidebar();
            } else {
                const links = document.querySelectorAll('.nav-link');
                if(type === 'luckyday') links[1].classList.add('active');
                if(type === 'weekly') links[2].classList.add('active');
            }
            
            const clearBtn = document.getElementById('clearAllBtn');
            if(type === 'stats') {
                document.getElementById('statsSection').classList.remove('hidden');
                document.getElementById('tableSection').classList.add('hidden');
                document.getElementById('headerTitle').innerText = "Live Console";
                clearBtn.classList.add('hidden');
                refreshStats();
            } else {
                document.getElementById('statsSection').classList.add('hidden');
                document.getElementById('tableSection').classList.remove('hidden');
                document.getElementById('headerTitle').innerText = type.toUpperCase() + " REGISTRY";
                clearBtn.classList.remove('hidden');
                fetchUsers(type, 1);
            }
        }

        function deleteUser(id, type) {
            Swal.fire({
                title: 'DELETE ENTRY?',
                text: "This record will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                confirmButtonText: 'YES, DELETE',
                cancelButtonText: 'CANCEL'
            }).then((result) => {
                if (result.isConfirmed) {
                    let fd = new FormData();
                    fd.append('id', id); fd.append('category', type);
                    fetch('delete_user.php', { method: 'POST', body: fd })
                    .then(() => { 
                        fetchUsers(type, currentPage); 
                        refreshStats(); 
                    });
                }
            });
        }

        function clearAllEntries() {
            Swal.fire({
                title: 'DELETE EVERYTHING?',
                text: `Clear all records from ${currentCategory.toUpperCase()}?`,
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'DELETE ALL',
                confirmButtonColor: '#ef4444'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'FINAL CHECK',
                        text: "Type 'DELETE' to confirm",
                        input: 'text',
                        showCancelButton: true,
                        preConfirm: (val) => { 
                            if(val !== 'DELETE') Swal.showValidationMessage('Type DELETE correctly'); 
                        }
                    }).then((res) => {
                        if(res.isConfirmed) {
                            let fd = new FormData();
                            fd.append('category', currentCategory);
                            fetch('clear_all.php', { method: 'POST', body: fd })
                            .then(() => { 
                                fetchUsers(currentCategory, 1); 
                                refreshStats(); 
                            });
                        }
                    });
                }
            });
        }

        window.onload = () => { 
            refreshStats(); 
            startAutoRefresh(); // Start live polling
        };
    </script>
</body>
</html>