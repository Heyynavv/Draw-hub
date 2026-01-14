<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAE Lottery | Admin Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .glass { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); }
        .sidebar-transition { transition: transform 0.3s ease-in-out; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#0f172a] text-slate-200 overflow-hidden font-sans">

    <div class="flex h-screen relative">
        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/60 z-20 hidden md:hidden"></div>

        <aside id="sidebar" class="fixed md:relative w-64 h-full bg-[#1e293b] border-r border-slate-700 z-30 sidebar-transition -translate-x-full md:translate-x-0 flex flex-col">
            <div class="p-6 text-xl font-black text-white border-b border-slate-700 flex justify-between items-center">
                <span>UAE <span class="text-blue-500">PRO</span></span>
                <button onclick="toggleSidebar()" class="md:hidden text-slate-400"><i class="fas fa-times"></i></button>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <button onclick="switchTab('stats', this)" class="nav-btn w-full flex items-center space-x-3 p-3 rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-500/20">
                    <i class="fas fa-chart-line"></i> <span class="font-bold">Analytics</span>
                </button>
                <button onclick="switchTab('luckyday', this)" class="nav-btn w-full flex items-center space-x-3 p-3 rounded-xl hover:bg-slate-700 transition-all">
                    <i class="fas fa-sun text-yellow-500"></i> <span>Lucky Day List</span>
                </button>
                <button onclick="switchTab('weekly', this)" class="nav-btn w-full flex items-center space-x-3 p-3 rounded-xl hover:bg-slate-700 transition-all">
                    <i class="fas fa-calendar-alt text-blue-500"></i> <span>Weekly List</span>
                </button>
            </nav>
            <div class="p-4 border-t border-slate-700">
                <button class="w-full py-2 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all font-bold italic">Logout</button>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-full overflow-hidden">
            <header class="h-16 bg-[#1e293b]/50 backdrop-blur-md border-b border-slate-700 flex items-center justify-between px-6 shrink-0">
                <div class="flex items-center space-x-4">
                    <button onclick="toggleSidebar()" class="md:hidden p-2 text-white"><i class="fas fa-bars"></i></button>
                    <h2 id="headerTitle" class="text-lg font-bold">Dashboard Overview</h2>
                </div>
                <div class="text-xs text-slate-400 italic">2026 Admin Active</div>
            </header>

            <div id="contentView" class="flex-1 overflow-y-auto p-4 md:p-8">
                
                <div id="statsSection" class="space-y-6 animate-in fade-in duration-500">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="glass p-6 rounded-2xl">
                            <p class="text-slate-400 text-xs font-bold uppercase mb-1">Total Users</p>
                            <h3 class="text-3xl font-black text-white">1,284</h3>
                        </div>
                        <div class="glass p-6 rounded-2xl">
                            <p class="text-slate-400 text-xs font-bold uppercase mb-1">Lucky Day Hits</p>
                            <h3 class="text-3xl font-black text-blue-500">452</h3>
                        </div>
                        <div class="glass p-6 rounded-2xl">
                            <p class="text-slate-400 text-xs font-bold uppercase mb-1">Active Weekly</p>
                            <h3 class="text-3xl font-black text-purple-500">832</h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="glass p-6 rounded-2xl">
                            <h4 class="font-bold mb-4 flex items-center"><i class="fas fa-users-cog mr-2 text-blue-500"></i> Registration Traffic</h4>
                            <canvas id="trafficChart" height="200"></canvas>
                        </div>
                        <div class="glass p-6 rounded-2xl flex flex-col items-center">
                            <h4 class="font-bold mb-4 w-full">Category Share</h4>
                            <div class="w-full max-w-[250px]">
                                <canvas id="shareChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tableSection" class="hidden">
                    <div class="glass rounded-2xl overflow-hidden shadow-2xl">
                        <div class="p-4 bg-slate-800/50 border-b border-slate-700 flex justify-between items-center">
                            <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Database Entries</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-slate-800/80 text-slate-500 text-[10px] font-black uppercase">
                                    <tr>
                                        <th class="p-4">User Details</th>
                                        <th class="p-4">Lottery #</th>
                                        <th class="p-4">Category</th>
                                        <th class="p-4">Draw Date</th>
                                        <th class="p-4 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody" class="divide-y divide-slate-700/50 text-sm">
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('overlay').classList.toggle('hidden');
        }

        function switchTab(type, btn) {
            const stats = document.getElementById('statsSection');
            const table = document.getElementById('tableSection');
            const title = document.getElementById('headerTitle');
            
            // UI Button Toggle
            document.querySelectorAll('.nav-btn').forEach(b => {
                b.classList.remove('bg-blue-600', 'text-white');
                b.classList.add('hover:bg-slate-700');
            });
            btn.classList.add('bg-blue-600', 'text-white');

            if(type === 'stats') {
                stats.classList.remove('hidden');
                table.classList.add('hidden');
                title.innerText = "Dashboard Overview";
            } else {
                stats.classList.add('hidden');
                table.classList.remove('hidden');
                title.innerText = type === 'luckyday' ? "Lucky Day Users" : "Weekly Draw Users";
                fetchUsers(type);
            }
            if(window.innerWidth < 768) toggleSidebar();
        }

        function fetchUsers(type) {
            const tbody = document.getElementById('userTableBody');
            tbody.innerHTML = "<tr><td colspan='5' class='p-10 text-center animate-pulse text-blue-400'>Syncing with MySQL...</td></tr>";

            fetch('fetch_users.php?category=' + type)
            .then(res => res.text())
            .then(data => { tbody.innerHTML = data; });
        }

        // --- INTERACTIVE GRAPHS ---
        const ctx1 = document.getElementById('trafficChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Registrations',
                    data: [12, 19, 13, 25, 22, 30, 45],
                    borderColor: '#3b82f6',
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(59, 130, 246, 0.1)'
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { grid: { color: '#334155' } }, x: { grid: { display: false } } } }
        });

        const ctx2 = document.getElementById('shareChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Lucky Day', 'Weekly'],
                datasets: [{
                    data: [65, 35],
                    backgroundColor: ['#3b82f6', '#a855f7'],
                    borderWidth: 0
                }]
            },
            options: { cutout: '80%', plugins: { legend: { position: 'bottom', labels: { color: '#94a3b8' } } } }
        });

        function deleteUser(id, type) {
    Swal.fire({
        title: 'Are you sure?',
        text: `User ID ${id} ko database se permanent delete kar dein?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#334155',
        confirmButtonText: 'Yes, Delete it!',
        background: '#1e293b',
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            // FormData banao backend ko bhejne ke liye
            let formData = new FormData();
            formData.append('id', id);
            formData.append('category', type);

            // Real-time delete request
            fetch('delete_user.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(response => {
                if(response.trim() === 'success') {
                    Swal.fire('Deleted!', 'Entry database se hat gayi hai.', 'success');
                    fetchUsers(type); // Table ko turant refresh karo
                } else {
                    Swal.fire('Error!', 'Kuch galat hua, try again.', 'error');
                }
            });
        }
    });
}
    </script>
</body>
</html>