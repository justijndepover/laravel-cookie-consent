<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCookiesTable extends Migration
{
    public function up()
    {
        Schema::create('cookies', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('length')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cookies');
    }
}
