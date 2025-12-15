<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_vente')->unique();
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('set null');
            $table->string('client_nom')->nullable();
            $table->string('client_telephone', 20)->nullable();
            $table->text('client_adresse')->nullable();
            $table->decimal('montant_total', 12, 0)->default(0)->comment('FCFA');
            $table->enum('mode_paiement', ['especes', 'mobile_money', 'carte', 'cheque'])->default('especes');
            $table->foreignId('user_id')->constrained('users')->comment('Vendeur');
            $table->text('notes')->nullable();
            $table->enum('statut', ['en_cours', 'terminee', 'annulee'])->default('en_cours');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ventes');
    }
};
