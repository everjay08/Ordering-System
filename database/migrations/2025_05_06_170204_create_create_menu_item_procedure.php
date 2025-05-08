<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS create_menu_item;
            CREATE PROCEDURE create_menu_item (
                IN p_name VARCHAR(255),
                IN p_description VARCHAR(255),
                IN p_price INT,
                IN p_is_available BOOLEAN,
                IN p_category_id BIGINT,
                IN p_image VARCHAR(255),
                OUT last_id BIGINT
            )
            BEGIN
                INSERT INTO menu_items (name, description, price, is_available, category_id, image, created_at, updated_at)
                VALUES (p_name, p_description, p_price, p_is_available, p_category_id, p_image, NOW(), NOW());

                SET last_id = LAST_INSERT_ID();
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS create_menu_item");
    }
};
