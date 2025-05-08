<?php
// app/Services/ReportService.php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class ReportService
{
    public function getDailySalesReport($startDate, $endDate)
    {
        return DB::select('CALL get_daily_sales_report(?, ?)', [$startDate, $endDate]);
    }

    public function getMostOrderedItems($startDate, $endDate, $limit = 5)
    {
        return DB::select('CALL get_most_ordered_items(?, ?, ?)', [$startDate, $endDate, $limit]);
    }
}
