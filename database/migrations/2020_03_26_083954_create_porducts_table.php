<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePorductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('porducts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('CatId')->nullable();
            $table->bigInteger('SubCatId')->nullable();
            $table->string('ProductName')->nullable();
            $table->string('Slug')->nullable();
            $table->text('ProductSummary')->nullable();
            $table->text('ProductDescription')->nullable();
            $table->string('ProductPrice')->nullable();
            $table->string('ProductQuantity')->nullable();
            $table->string('ProductThambnail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('porducts');
    }
}
