<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->integer('type');
            $table->double('lat');
            $table->double('lang');
            $table->timestamps();


            $table->foreign('village_id')->on('villages')->references('id');
            $table->foreign('district_id')->on('districts')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
