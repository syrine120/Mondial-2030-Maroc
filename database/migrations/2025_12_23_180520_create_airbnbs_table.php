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
    Schema::create('airbnbs', function (Blueprint $table) {
      $table->id();
      $table->string('nom', 150);
      $table->foreignId('ville_id')->constrained('villes')->onDelete('cascade');
      $table->text('adresse')->nullable();
      $table->string('telephone', 20)->nullable();
      $table->string('proprietaire', 100)->nullable();
      $table->decimal('prix_nuit', 8, 2)->nullable();
      $table->integer('chambres')->nullable();
      $table->integer('capacite')->nullable();
      $table->string('image_url', 255)->nullable();
      $table->text('description')->nullable();
      $table->timestamps();
    });
  }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airbnbs');
    }
};
