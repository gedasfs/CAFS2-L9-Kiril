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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            $table->boolean('is_active')->default(FALSE);

            $table->unsignedTinyInteger('stock')->default(0);

            $table->string('name');
            $table->text('description');

            $table->string('identifier')->unique();

            $table->decimal('price', 10, 2)->nullable();

            $table->json('details')->nullable();

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
};
