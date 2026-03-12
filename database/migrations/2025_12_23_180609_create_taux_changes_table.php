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
    Schema::create('taux_changes', function (Blueprint $table) {
      $table->id();
      $table->string('devise_source', 10);
      $table->string('devise_cible', 10);
      $table->decimal('taux', 10, 6);
      $table->timestamp('date_update')->useCurrent()->useCurrentOnUpdate();
    });
  }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taux_changes');
    }
};
