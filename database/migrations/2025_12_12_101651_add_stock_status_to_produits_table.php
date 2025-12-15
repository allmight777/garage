<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddStockStatusToProduitsTable extends Migration
{
    public function up()
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->enum('stock_status', ['normal', 'faible', 'rupture', 'alerte'])
                  ->default('normal')
                  ->after('seuil_alerte');
        });

        // Mettre à jour les statuts existants
        DB::statement("
            UPDATE produits
            SET stock_status = CASE
                WHEN stock_actuel = 0 THEN 'rupture'
                WHEN stock_actuel <= (seuil_alerte * 0.3) THEN 'faible'
                ELSE 'normal'
            END
        ");
    }

    public function down()
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropColumn('stock_status');
        });
    }
}
