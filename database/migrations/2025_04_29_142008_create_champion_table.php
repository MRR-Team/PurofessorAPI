<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('champions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');

            $table->boolean('attack_damage');
            $table->boolean('magic_damage');
            $table->boolean('shield');
            $table->boolean('heals');
            $table->boolean('tanky');
            $table->boolean('squishy');
            $table->boolean('has_cc');
            $table->boolean('dash');
            $table->boolean('poke');
            $table->boolean('can_one_shot');
            $table->boolean('late_game');

            $table->unsignedTinyInteger('is_good_against_attack_damage');
            $table->unsignedTinyInteger('is_good_against_magic_damage');
            $table->unsignedTinyInteger('is_good_against_shield');
            $table->unsignedTinyInteger('is_good_against_heals');
            $table->unsignedTinyInteger('is_good_against_tanky');
            $table->unsignedTinyInteger('is_good_against_squish');
            $table->unsignedTinyInteger('is_good_against_has_cc');
            $table->unsignedTinyInteger('is_good_against_dash');
            $table->unsignedTinyInteger('is_good_against_poke');
            $table->unsignedTinyInteger('is_good_against_can_one_shot');
            $table->unsignedTinyInteger('is_good_against_late_game');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('champions');
    }
};
