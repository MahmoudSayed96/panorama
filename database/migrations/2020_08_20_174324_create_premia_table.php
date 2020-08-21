<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premia', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_phone')->unique();
            $table->text('details')->nullable();
            $table->decimal('alqist_amount', 10, 2);
            $table->decimal('remaining_amount', 10, 2);
            $table->date('end_amount_date');
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
        Schema::dropIfExists('premia');
    }
}
