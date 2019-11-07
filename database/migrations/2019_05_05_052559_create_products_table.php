<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->text('description')->nullable();
            $table->string('color')->nullable()->default(null);
            $table->string('type_of_product')->nullable()->default(null);
            $table->string('sub_type_of_product')->nullable()->default(null);
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('weight')->nullable()->default(0);
            $table->integer('price')->nullable()->default(0);

            $table->boolean('remote_controller')->nullable()->default(false);
            $table->boolean('zero_g')->nullable()->default(false);
            $table->boolean('timer')->nullable()->default(false);
            $table->string('type_controller')->nullable()->default(null);
            $table->integer('count_program')->nullable()->default(0);
            $table->integer('discount')->nullable()->default(0);
            $table->boolean('warming_up')->nullable()->default(false);
            $table->boolean('available')->nullable()->default(false);
            $table->string('massage_area')->nullable()->default(null);
            $table->string('brochure')->nullable()->default(null);

            $table->boolean('status')->nullable()->default(false);

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
        Schema::dropIfExists('products');
    }
}
