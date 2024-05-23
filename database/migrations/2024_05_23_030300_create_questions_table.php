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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->enum('type',['text','image']);
            $table->string('answer');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('editor_id')->nullable();
            $table->timestamps();


            $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('editor_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
