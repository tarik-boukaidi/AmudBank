<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();  // transaction_id
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // user_id
            $table->string('numero_carte');
            $table->string('compte_source');
            $table->decimal('montant', 10, 2);  // amount
            $table->enum('status',  ['en_attente', 'terminée', 'échouée'])->default('terminée'); 
            $table->enum('transaction_type', [
                'dépôt', 'retrait', 'paiement', 'virement',
                'remboursement', 'litige', 'frais', 'abonnement']);
            $table->text('description')->nullable();
            $table->string('nom_complete');
            $table->string('numero_carte_destination');
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
