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
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('id'); // Auto Increment Tipe Integer
            $table->unsignedBigInteger('user_id'); // Unsigned Big Integer
            $table->string('nama',100); // string dengan Panjang Maks 100
            $table->string('nim');
            $table->enum('gender',['male','female']); //ENUM dengan 2 tipe
            $table->text('alamat');
            $table->string('nomor');
            $table->char('email')->unique(); //char yang unique
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
