<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCloseAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('close_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->decimal('previous', 8, 2)->default(0.00);
            $table->decimal('current', 8, 2)->default(0.00);
            $table->decimal('debit', 8, 2)->default(0.00);
            $table->decimal('credit', 8, 2)->default(0.00);
            $table->decimal('balance', 8, 2)->default(0.00);
            $table->decimal('commission', 8, 2)->default(0.00);
            $table->date('date')->nullable();
            $table->morphs('closeable');
            $table->bigInteger('user_id')->nullable();
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
        Schema::dropIfExists('close_accounts');
    }
}
