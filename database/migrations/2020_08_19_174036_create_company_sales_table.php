<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('buyer_name');
            $table->string('buyer_phone')->unique();
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('company_sales');
    }
}
