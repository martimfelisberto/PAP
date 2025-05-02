<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artigos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->decimal('preco', 8, 2);
            $table->string('marca');
            $table->string('categoria');
            $table->string('estado');
            $table->string('tamanho')->nullable();
            $table->string('cores')->nullable();
            $table->string('imagem');
            $table->boolean('destaque')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::create('artigos', function (Blueprint $table) {
            // ...
            $table->id();
            $table->string('estado')->nullable(false); // NOT NULL por padrão
            $table->timestamps();
            // ...
        });
    }

   
};