<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            DB::unprepared('
                CREATE TRIGGER update_foundation_date
                BEFORE UPDATE ON companies
                FOR EACH ROW
                BEGIN
                    IF NEW.foundation_date != OLD.foundation_date THEN
                        SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "The registration date cannot be modify!";
                    END IF;
                END
            ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            DB::unprepared('DROP TRIGGER IF EXISTS update_foundation_date');
        });
    }
};
