<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('supplier')->nullable();
            $table->integer('items')->default(0);
            $table->integer('qty')->default(0);
            $table->decimal('total_discount', 8, 2)->default(0.00);
            $table->decimal('total_tax', 8, 2)->default(0.00);
            $table->decimal('total_cost', 8, 2)->default(0.00);
            $table->decimal('shipping_cost', 8, 2)->default(0.00);
            $table->decimal('grand_total', 8, 2)->default(0.00);
            $table->decimal('paid_amount', 8, 2)->default(0.00);
            $table->decimal('remaining_amount', 8, 2)->default(0.00);
            $table->string('status')->default(1);
            $table->string('payment_status')->default(1);
            $table->date('date')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
