<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS get_top_ordered_menu_items;

            CREATE PROCEDURE get_top_ordered_menu_items(IN limitCount INT)
            BEGIN
                SELECT 
                    mi.id,
                    mi.name,
                    COUNT(omi.menu_item_id) AS order_count
                FROM order_menu_item omi
                JOIN menu_items mi ON omi.menu_item_id = mi.id
                GROUP BY mi.id, mi.name
                ORDER BY order_count DESC
                LIMIT limitCount;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS get_top_ordered_menu_items;");
    }
};
