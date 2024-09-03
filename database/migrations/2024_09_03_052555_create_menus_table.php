<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Menu title
            $table->integer('depth')->default(0); // Depth of the menu item in the hierarchy
            $table->unsignedBigInteger('parent_id')->nullable(); // Parent menu item (nullable for root items)
            $table->integer('lft')->nullable(); // Left value for nested set model
            $table->integer('rgt')->nullable(); // Right value for nested set model
            $table->timestamps(); // Created_at and Updated_at columns

            // Foreign key constraint linking to the same table for parent-child relationships
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
