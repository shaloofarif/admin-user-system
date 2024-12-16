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
        Schema::create('ips', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key referencing 'users' table
            $table->string('ip_address'); // IP address
            $table->timestamp('logged_in_at'); // Timestamp of login
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('ips');
    }
};
