<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE users ADD FULLTEXT fulltext_index (name, email)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE users DROP INDEX fulltext_index');
    }
};
