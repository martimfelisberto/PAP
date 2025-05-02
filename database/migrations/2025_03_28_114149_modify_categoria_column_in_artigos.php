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
        Schema::table('artigos', function (Blueprint $table) {
            $table->json('artigos')->change(); // Transformando a coluna em JSON
        });
    }

    public function down()
    {
        Schema::table('artigos', function (Blueprint $table) {
            $table->string('artigos')->change(); // Voltando para string caso precise desfazer
        });
    }

};
