<?php
// Path Fix using __DIR__
include __DIR__ . '/../includes/db.php'; 

// PHP Level par India Timezone set karein
date_default_timezone_set('Asia/Kolkata');

// Cache control
header("Cache-Control: no-cache, must-revalidate");

$category = $_GET['category'] ?? 'luckyday';
$search = $_GET['search'] ?? '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$table = ($category == 'luckyday') ? 'luckyday_users' : 'weekly_users';

$searchQuery = "";
if(!empty($search)){
    $searchQuery = " WHERE name LIKE '%$search%' OR phone LIKE '%$search%' OR lottery_number LIKE '%$search%' ";
}

// 1. Total Count
$countQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM $table $searchQuery");
$totalRows = mysqli_fetch_assoc($countQuery)['total'];
$totalPages = ceil($totalRows / $limit);
$display_id = $totalRows - $offset;

/**
 * CLEAN QUERY:
 * Humne db.php mein SET time_zone = '+05:30' pehle hi kar diya hai,
 * isliye yahan ab extra DATE_ADD ki zaroorat nahi hai.
 */
$query = "SELECT * FROM $table $searchQuery ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        
        $current_display_uid = $display_id--; 
        
        // India Time formatted display
        $reg_time = date("d M, h:i A", strtotime($row['created_at']));
        $draw_date = date("d M Y", strtotime($row['draw_date']));

        echo "
        <tr class='border-b border-slate-50 hover:bg-slate-50/50 transition-all'>
            <td class='p-8 font-mono text-xs text-blue-500 font-bold'>#{$current_display_uid}</td>
            <td class='p-8'>
                <div class='flex flex-col'>
                    <span class='text-slate-900 font-extrabold uppercase tracking-tight'>{$row['name']}</span>
                    <span class='text-[10px] text-slate-400 font-bold'>{$row['phone']}</span>
                </div>
            </td>
            <td class='p-8'>
                <span class='bg-blue-600 text-white px-3 py-1.5 rounded-lg font-black text-xs shadow-sm italic tracking-widest'>
                    {$row['lottery_number']}
                </span>
            </td>
            <td class='p-8'>
                <div class='flex flex-col'>
                    <span class='text-slate-700 font-bold text-xs'>$reg_time</span>
                    <span class='text-[9px] text-emerald-500 uppercase font-black'>Registered At (IST)</span>
                </div>
            </td>
            <td class='p-8'>
                <div class='flex flex-col'>
                    <span class='text-blue-700 font-bold text-xs'>$draw_date</span>
                    <span class='text-[9px] text-slate-400 uppercase font-black'>Draw Date</span>
                </div>
            </td>
            <td class='p-8 text-center'>
                <button onclick=\"deleteUser({$row['id']}, '$category')\" class='w-9 h-9 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm flex items-center justify-center mx-auto'>
                    <i class='fas fa-trash-alt text-xs'></i>
                </button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='p-20 text-center text-slate-300 font-black uppercase italic tracking-widest'>No Records Found</td></tr>";
}

echo "<input type='hidden' id='totalPagesHidden' value='$totalPages'>";
echo "<input type='hidden' id='currentCountHidden' value='$totalRows'>";
?>