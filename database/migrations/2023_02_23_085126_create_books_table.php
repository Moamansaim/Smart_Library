<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name',30)->unique();
            $table->integer('version');
            $table->string('language',3);
            $table->foreignId('category_id');
            $table->foreignId('writer_id');
            $table->foreignId('homePublish_id');
            $table->string('status',10);
            $table->string('image');
            $table->string('pdf');
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('writer_id')->references('id')->on('writers')->cascadeOnDelete();
            $table->foreign('homePublish_id')->references('id')->on('home_publishes')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
