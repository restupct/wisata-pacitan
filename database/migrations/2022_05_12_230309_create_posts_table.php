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
    Schema::create('posts', function (Blueprint $table) {
      $table->id();
      // fk tabel category
      $table->foreignId('category_id');
      // fk tabel user
      $table->foreignId('user_id');
      $table->string('title');
      $table->string('slug');
      $table->text('excerpt');
      $table->text('body');
      $table->integer('status')->default(0);
      $table->string('gambar')->nullable();
      $table->text('keterangan')->nullable();
      $table->text('lokasi')->nullable();
      $table->string('published_at')->nullable();
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
    Schema::dropIfExists('posts');
  }
};
