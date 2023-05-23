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
        Schema::create('companies', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('registration_number', 11);
            $table->date('foundation_date');
            $table->string('country', 64);
            $table->string('zip_code', 32);
            $table->string('city');
            $table->string('street_address');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('owner');
            $table->integer('employees');
            $table->string('activity');
            $table->boolean('active');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
