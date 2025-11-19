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
        Schema::create('notificator_sender_history', function (Blueprint $table) {
            $table->id();
            $table->string('type', 32);
            $table->unsignedInteger('userid');
            $table->text('message');
            $table->boolean('success')->default(true);
            $table->text('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificator_sender_history');
    }
};
