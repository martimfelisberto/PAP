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
        if (!Schema::hasColumn('artigos', 'imagem')) {
            Schema::table('artigos', function (Blueprint $table) {
                $table->string('imagem')->nullable();
            });
        }
    }
    
    public function down()
    {
        Schema::table('artigos', function (Blueprint $table) {
            $table->dropColumn('imagem');
        });
    }

};