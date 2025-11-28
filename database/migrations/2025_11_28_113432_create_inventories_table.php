<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('sku')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->string('image')->nullable();
            $table->enum('condition', ['new', 'good', 'used', 'broken'])->default('good');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventories');
    }
};
