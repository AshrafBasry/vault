<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaultLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vault_ledgers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order');
            $table->decimal('amount', 10, 2);
            $table->decimal('balance', 10, 2)->unsigned();
            $table->date('date');
            $table->text('reason');
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
        Schema::dropIfExists('vault_ledgers');
    }
}
