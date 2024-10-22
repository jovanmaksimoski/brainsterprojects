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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('theme');
            $table->text('description');
            $table->text('objective');
            $table->string('location');
            $table->dateTime('date');
            $table->string('status');
            $table->unsignedBigInteger('agendas_id')->nullable();
            $table->foreign('agendas_id')->references('id')->on('agendas')->cascadeOnDelete();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
