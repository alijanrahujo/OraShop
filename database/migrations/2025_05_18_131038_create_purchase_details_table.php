<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('accessory_id');
            $table->integer('qty')->default(0);
            $table->decimal('unit_cost', 8, 2)->default(0.00);
            $table->decimal('discount', 8, 2)->default(0.00);
            $table->decimal('tax', 8, 2)->default(0.00);
            $table->decimal('total', 8, 2)->default(0.00);
            $table->foreignId('purchase_id')->constrained('purchases')->cascadeOnDelete();
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
        Schema::dropIfExists('purchase_details');
    }
}
