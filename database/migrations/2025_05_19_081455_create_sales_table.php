<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->integer('items')->default(0);
            $table->integer('qty')->default(0);
            $table->decimal('total_discount', 8, 2)->default(0.00);
            $table->decimal('total_tax', 8, 2)->default(0.00);
            $table->decimal('total_cost', 8, 2)->default(0.00);
            $table->decimal('shipping_cost', 8, 2)->default(0.00);
            $table->decimal('grand_total', 8, 2)->default(0.00);
            $table->decimal('paid_amount', 8, 2)->default(0.00);
            $table->decimal('remaining_amount', 8, 2)->default(0.00);
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
        Schema::dropIfExists('sales');
    }
}
