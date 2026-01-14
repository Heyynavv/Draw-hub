<?php
include '../includes/db.php';

$category = $_GET['category'] ?? 'luckyday';
$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$table = ($category == 'luckyday') ? 'luckyday_users' : 'weekly_users';

// Search Query logic
$searchQuery = "";
if(!empty($search)){
    $searchQuery = " WHERE name LIKE '%$search%' OR phone LIKE '%$search%' OR lottery_number LIKE '%$search%' ";
}

// Total Count for Pagination
$countQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM $table $searchQuery");
$totalRows = mysqli_fetch_assoc($countQuery)['total'];
$totalPages = ceil($totalRows / $limit);

$query = "SELECT * FROM $table $searchQuery ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='border-b border-slate-50 hover:bg-slate-50/50 transition-all'>
                <td class='p-8'>#{$row['id']}</td>
                <td class='p-8'>
                    <div class='flex flex-col'>
                        <span class='text-slate-900'>{$row['name']}</span>
                        <span class='text-xs text-slate-400'>{$row['phone']}</span>
                    </div>
                </td>
                <td class='p-8'><span class='bg-blue-50 text-blue-600 px-3 py-1 rounded-lg'>{$row['lottery_number']}</span></td>
                <td class='p-8 text-slate-400 text-sm'>{$row['draw_date']}</td>
                <td class='p-8 text-center'>
                    <button onclick='deleteUser({$row['id']}, \"$category\")' class='text-red-400 hover:text-red-600 p-2'><i class='fas fa-trash-alt'></i></button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5' class='p-20 text-center text-slate-300 uppercase italic'>No Records Found</td></tr>";
}

// Hidden field to pass total pages back to JS
echo "<input type='hidden' id='totalPagesHidden' value='$totalPages'>";
echo "<input type='hidden' id='currentPageHidden' value='$page'>";
echo "<input type='hidden' id='currentCountHidden' value='$totalRows'>";
?>