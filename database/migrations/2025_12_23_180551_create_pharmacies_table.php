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
    Schema::create('pharmacies', function (Blueprint $table) {
      $table->id();
      $table->string('nom', 150);
      $table->foreignId('ville_id')->constrained('villes')->onDelete('cascade');
      $table->text('adresse')->nullable();
      $table->string('telephone', 20)->nullable();
      $table->text('horaires_ouverture')->nullable();
      $table->text('horaires_fermeture')->nullable();
      $table->decimal('latitude', 10, 8)->nullable();
      $table->decimal('longitude', 11, 8)->nullable();
      $table->timestamps();
    });
  }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
