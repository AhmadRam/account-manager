<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('currency_id')->constrained()->onDelete('cascade');
            $table->decimal('balance', 15, 2)->default(0);
            $table->timestamps();
            
            $table->unique(['person_id', 'currency_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
