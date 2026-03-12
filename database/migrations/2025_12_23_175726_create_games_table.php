<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void {
    Schema::create('games', function (Blueprint $table) {
      $table->id();
      $table->foreignId('stade_id')->constrained('stades')->onDelete('cascade');
      $table->string('equipe1', 100)->nullable();
      $table->string('equipe2', 100)->nullable();
      $table->date('date_match');
      $table->time('heure_match');
      $table->string('type_match', 50)->nullable();
      $table->timestamps();
    });
  }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
