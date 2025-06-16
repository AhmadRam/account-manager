<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique(); // USD, EUR, SAR
            $table->string('name');
            $table->string('symbol');
            $table->decimal('rate_to_usd', 10, 4)->default(1); // معدل التحويل للدولار
            $table->boolean('is_base')->default(false); // العملة الأساسية
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
