<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            CREATE PROCEDURE sp_insert_shop_table (
                IN p_table_number VARCHAR(255),
                IN p_capacity INT,
                IN p_is_available BOOLEAN,
                OUT last_id INT
            )
            BEGIN
                INSERT INTO shop_tables (table_number, capacity, is_available, created_at, updated_at)
                VALUES (p_table_number, p_capacity, p_is_available, NOW(), NOW());

                SET last_id = LAST_INSERT_ID();
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_insert_shop_table');
    }
};