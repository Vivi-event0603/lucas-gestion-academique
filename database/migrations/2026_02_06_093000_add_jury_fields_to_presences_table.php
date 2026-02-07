<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('presences', function (Blueprint $table) {
            if (!Schema::hasColumn('presences', 'directeur_memoire')) {
                $table->string('directeur_memoire')->nullable();
            }
            if (!Schema::hasColumn('presences', 'evaluateur')) {
                $table->string('evaluateur')->nullable();
            }
            if (!Schema::hasColumn('presences', 'president_jury')) {
                $table->string('president_jury')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('presences', function (Blueprint $table) {
            if (Schema::hasColumn('presences', 'directeur_memoire')) {
                $table->dropColumn('directeur_memoire');
            }
            if (Schema::hasColumn('presences', 'evaluateur')) {
                $table->dropColumn('evaluateur');
            }
            if (Schema::hasColumn('presences', 'president_jury')) {
                $table->dropColumn('president_jury');
            }
        });
    }
};
