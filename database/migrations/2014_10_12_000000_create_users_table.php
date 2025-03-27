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
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('alamat');
      $table->string('tanggal_lahir');
      $table->char('jenis_kelamin');
      $table->char('no_hp', 12);
      $table->string('foto')->nullable();
      $table->string('email')->unique();
      $table->string('password');
      $table->enum('role', ['admin', 'user'])->default('user');
      $table->integer('rating');
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
    Schema::dropIfExists('users');
  }
};
