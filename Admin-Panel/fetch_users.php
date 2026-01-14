<?php
// Database connection include
include '../includes/db.php'; 

// Category check (luckyday ya weekly)
$category = isset($_GET['category']) ? $_GET['category'] : 'luckyday';

// Screenshots ke hisaab se sahi table choose karna
if($category == 'luckyday') {
    $table = 'luckyday_users';
} else {
    $table = 'weekly_users';
}

// Data fetch query
$result = mysqli_query($conn, "SELECT * FROM $table ORDER BY id DESC");

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // Screenshots ke exact columns use kar rahe hain
        echo "
        <tr class='hover:bg-white/5 border-b border-white/5 transition-all group'>
            <td class='p-6'>
                <div class='flex items-center space-x-3'>
                    <div class='w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center font-bold text-blue-500 uppercase'>
                        ".substr($row['name'], 0, 1)."
                    </div>
                    <div>
                        <p class='text-white font-bold'>".$row['name']."</p>
                        <p class='text-xs text-slate-500'>".$row['phone']."</p>
                    </div>
                </div>
            </td>
            <td class='p-6'>
                <span class='font-mono text-blue-400 bg-blue-400/10 px-3 py-1.5 rounded-lg border border-blue-400/20'>
                    ".$row['lottery_number']."
                </span>
            </td>
            <td class='p-6 text-[10px] font-black uppercase tracking-widest'>
                <span class='px-3 py-1 rounded-full ".($category == 'luckyday' ? 'bg-yellow-500/10 text-yellow-500' : 'bg-purple-500/10 text-purple-500')."'>
                    $category
                </span>
            </td>
            <td class='p-6 text-slate-500 text-xs'>
                ".$row['draw_date']."
            </td>
            <td class='p-6 text-center'>
                <button onclick='deleteUser(".$row['id'].", \"$category\")' class='w-10 h-10 rounded-xl bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-lg shadow-red-500/10'>
                    <i class='fas fa-trash'></i>
                </button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5' class='p-20 text-center text-slate-500 italic'>No records found in $table table.</td></tr>";
}
?>