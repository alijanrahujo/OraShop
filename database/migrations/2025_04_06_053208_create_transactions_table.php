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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Polymorphic relation to Account, Load, or Accessory
            $table->unsignedBigInteger('transactionable_id');
            $table->string('transactionable_type');

            $table->enum('type', ['deposit', 'withdrawal', 'transfer', 'purchase', 'sale']);
            $table->decimal('amount', 15, 2);
            $table->decimal('entry_amount', 15, 2);
            $table->text('description')->nullable();
            $table->date('transaction_date')->nullable();
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
