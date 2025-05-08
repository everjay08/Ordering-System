<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_shop_tables AS
            SELECT id, table_number, capacity, is_available, created_at, updated_at
            FROM shop_tables
        ");
    }


    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_shop_tables");
    }
};
