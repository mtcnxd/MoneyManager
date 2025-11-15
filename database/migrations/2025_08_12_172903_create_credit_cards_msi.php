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
        Schema::create('credit_cards_msi', function (Blueprint $table) {
            $table->id();
            $table->integer('mov_id');
            $table->integer('pay_number')->nullable();
            $table->double('price');
            $table->enum('status', ['Pending','Paid'])->deafult('Pending');
            $table->date('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_cards_msi');
    }
};
