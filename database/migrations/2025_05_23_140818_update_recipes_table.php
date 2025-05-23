<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // Renomear instructions para content
            $table->renameColumn('instructions', 'content');

            // Adicionar occasion, type, skill e people se não existirem
            $table->string('occasion')->nullable()->after('title');
            $table->string('type')->nullable()->after('occasion');
            $table->string('skill')->nullable()->after('type');
            $table->unsignedInteger('people')->default(1)->after('skill');
        });
    }

    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // Reverter as alterações
            $table->renameColumn('content', 'instructions');
            $table->dropColumn('occasion');
            $table->dropColumn('type');
            $table->dropColumn('skill');
            $table->dropColumn('people');
        });
    }
};

