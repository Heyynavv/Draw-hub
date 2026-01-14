<?php
include '../includes/db.php'; 
$category = isset($_GET['category']) ? $_GET['category'] : 'luckyday';
$table = ($category == 'luckyday') ? 'luckyday_users' : 'weekly_users';

$result = mysqli_query($conn, "SELECT * FROM $table ORDER BY id DESC");
$total_rows = mysqli_num_rows($result);

echo "<input type='hidden' id='current-count-hidden' value='$total_rows'>";

if($total_rows > 0) {
    $sno = 1;
    while($row = mysqli_fetch_assoc($result)) {
        echo "
        <tr class='border-b border-slate-100 hover:bg-slate-50 transition-colors'>
            <td class='p-5 text-slate-400 font-bold'>#$sno</td>
            <td class='p-5'>
                <div class='font-extrabold text-slate-900 text-sm capitalize'>".$row['name']."</div>
                <div class='text-[11px] text-slate-400 font-bold'>".$row['phone']."</div>
            </td>
            <td class='p-5'>
                <span class='bg-blue-50 text-blue-600 px-3 py-1 rounded-lg font-mono font-black text-xs border border-blue-100'>
                    ".$row['lottery_number']."
                </span>
            </td>
            <td class='p-5 text-slate-500 text-xs font-bold'>".$row['draw_date']."</td>
            <td class='p-5 text-center'>
                <button onclick='deleteUser(".$row['id'].", \"$category\")' class='w-10 h-10 inline-flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-all'>
                    <i class='fas fa-trash-alt text-xs'></i>
                </button>
            </td>
        </tr>";
        $sno++;
    }
} else {
    echo "<tr><td colspan='5' class='p-20 text-center text-slate-400 italic font-bold'>Database is Empty</td></tr>";
}
?>