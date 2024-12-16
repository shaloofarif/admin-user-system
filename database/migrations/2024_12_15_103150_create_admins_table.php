<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('company_name'); // Admin's company name
            $table->string('mobile_no'); // Admin's mobile number
            $table->string('email')->unique(); // Admin's email
            $table->string('password'); // Admin's hashed password
            $table->timestamps(); // created_at and updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
