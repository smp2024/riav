<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('module')->default('0')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mobile_fit')->nullable();
            $table->date('date')->nullable();
            $table->string('sections')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
