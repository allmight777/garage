<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('marque')->nullable();
            $table->string('modele')->nullable();
            $table->decimal('prix_achat', 10, 2);
            $table->decimal('prix_vente', 10, 2);
            $table->integer('stock_actuel')->default(0);
            $table->integer('seuil_alerte')->default(10);
            $table->decimal('taux_tva', 5, 2)->default(20.00);
            $table->string('unite_mesure')->default('unité');
            $table->boolean('est_actif')->default(true);
            $table->foreignId('type_produit_id')->nullable()->constrained('type_produits')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
