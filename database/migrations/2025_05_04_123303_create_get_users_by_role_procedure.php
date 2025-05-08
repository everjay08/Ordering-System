<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS get_users_by_role;
            
            CREATE PROCEDURE get_users_by_role(IN user_role ENUM('Admin', 'Delivery', 'Customer'))
            BEGIN
                SELECT id, name, email, role, created_at
                FROM users
                WHERE role = user_role;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS get_users_by_role;");
    }
};
