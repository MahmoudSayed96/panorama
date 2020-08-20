<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutCompanySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_company_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('buyer_name');
            $table->string('buyer_phone')->unique();
            $table->decimal('price', 10, 2);
            $table->enum('wasit', [0, 1])->default(0);
            $table->text('indication');
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
        Schema::dropIfExists('out_company_sales');
    }
}
