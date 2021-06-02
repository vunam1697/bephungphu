<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
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
            $table->text('sku')->nullable();
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->text('image')->nullable();
            $table->text('sort_desc')->nullable();
            $table->text('content')->nullable();
            $table->text('specifications')->nullable();
            $table->text('attributes')->nullable();
            $table->text('content_gift')->nullable();
            $table->timestamp('start_date_apply_gift')->nullable();
            $table->timestamp('end_date_apply_gift')->nullable();
            $table->integer('regular_price')->nullable();
            $table->integer('sale_price')->nullable();
            $table->integer('sale')->nullable();
            $table->integer('is_hot')->nullable();
            $table->integer('is_flash_sale')->nullable();
            $table->integer('is_apply_gift')->nullable();
            $table->integer('status')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('meta_title')->nullable();
            $table->integer('meta_description')->nullable();
            $table->integer('meta_keyword')->nullable();
            $table->softDeletes();
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
