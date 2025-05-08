<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('ALTER TABLE menu_items ADD FULLTEXT(name)');
        DB::statement('ALTER TABLE menu_items ADD FULLTEXT(description)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE menu_items DROP INDEX name');
        DB::statement('ALTER TABLE menu_items DROP INDEX description');
    }
};

