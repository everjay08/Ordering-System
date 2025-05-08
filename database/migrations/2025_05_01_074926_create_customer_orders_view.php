<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR REPLACE VIEW view_customer_orders AS
            SELECT
                orders.id AS id,
                orders.total_amount,
                orders.status,
                orders.created_at,
                users.name AS customer_name,
                users.email,
                GROUP_CONCAT(menu_items.name SEPARATOR ', ') AS menu_items_names
            FROM orders
            JOIN users ON users.id = orders.customer_id
            JOIN order_menu_item ON order_menu_item.order_id = orders.id
            JOIN menu_items ON menu_items.id = order_menu_item.menu_item_id
            GROUP BY orders.id, orders.total_amount, orders.status, orders.created_at, users.name, users.email
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_customer_orders");
    }
};
