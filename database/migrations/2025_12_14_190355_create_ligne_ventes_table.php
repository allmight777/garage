<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ligne_ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vente_id')->constrained('ventes')->onDelete('cascade');
            $table->foreignId('produit_id')->constrained('produits')->onDelete('restrict');
            $table->integer('quantite');
            $table->decimal('prix_unitaire', 12, 0)->comment('FCFA');
            $table->decimal('sous_total', 12, 0)->virtualAs('quantite * prix_unitaire');
            $table->timestamps();
        });

        // Index pour performance
        Schema::table('ligne_ventes', function (Blueprint $table) {
            $table->index(['vente_id', 'produit_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('ligne_ventes');
    }
};
