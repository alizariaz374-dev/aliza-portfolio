<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_no');
            $table->text('about')->nullable();
            $table->string('certificate')->nullable();
            $table->text('certificate_description')->nullable();
            $table->text('linkedin_url')->nullable();
            $table->text('git_url')->nullable();
            $table->text('web_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
