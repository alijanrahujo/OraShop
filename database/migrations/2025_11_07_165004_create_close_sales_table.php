<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCloseSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('close_sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('sale_detail_id');
            $table->string('code');
            $table->string('title');
            $table->string('category');
            $table->decimal('purchase_price', 10, 2);
            $table->integer('qty');
            $table->decimal('unit_cost', 10, 2);
            $table->integer('total_qty');
            $table->decimal('commission', 10, 2);
            $table->decimal('profit', 10, 2);
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
        Schema::dropIfExists('close_sales');
    }
}
