<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('debtor_id_no');
            $table->integer('lender_id_no');
            $table->integer('amount');
            $table->integer('total_amount_and_interest');
            $table->integer('payment_duration');
            $table->integer('interest_rate_pm');
            $table->date('processing_date');
            $table->date('payment_end_date');
            $table->boolean('is_confirmed');
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
