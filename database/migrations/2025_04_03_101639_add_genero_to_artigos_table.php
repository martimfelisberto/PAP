<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('artigos', function (Blueprint $table) {
            $table->enum('genero', ['homem', 'mulher', 'crianca',])
                  ->after('descricao'); // Coloque após a coluna que fizer sentido
        });
    }

    public function down()
    {
        Schema::table('artigos', function (Blueprint $table) {
            $table->dropColumn('genero');
        });
    }
};