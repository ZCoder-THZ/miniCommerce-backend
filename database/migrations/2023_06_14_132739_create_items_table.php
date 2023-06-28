<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('uploader');
            $table->unsignedBigInteger('price');
            $table->longText('description');
            $table->enum('item_condition',['second','used','new']);
            $table->enum('item_type',['sell','buy','exchanged']);
               $table->enum('status', ['avail', 'unavail'])->default('avail');
            $table->string('image');
            $table->unsignedBigInteger('phone');

            $table->unsignedBigInteger('view_count')->default(1);
            $table->string('address');
            $table->double('ltd');
            $table->double('lng');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
