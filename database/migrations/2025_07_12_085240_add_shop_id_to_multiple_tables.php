<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShopIdToMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('accessories', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('loads', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('accessory_transaction_details', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('purchase_details', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('sale_details', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('close_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(1)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('accessories', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('loads', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('accessory_transaction_details', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('purchase_details', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('sale_details', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('close_accounts', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('shop_id');
        });
    }
}
