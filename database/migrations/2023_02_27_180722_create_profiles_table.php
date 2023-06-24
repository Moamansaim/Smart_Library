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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('first_name',15);
            $table->string('last_name',15);
            $table->string('country',30)->nullable();
            $table->string('language')->nullable();
            $table->string('organization')->nullable();
            $table->string('phone_number');
            $table->string('address');
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->foreignId('admin_id');
            $table->timestamps();
           
            $table->foreign('admin_id')->references('id')->on('admins')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
