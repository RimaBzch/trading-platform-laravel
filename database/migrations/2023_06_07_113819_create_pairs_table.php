<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairs', function (Blueprint $table) {
            $table->id();
            $table->string('pair_name');
            $table->timestamps();
        });

        $pairs = [
            'AUDCAD',
            'AUDCHF',
            'AUDJPY',
            'AUDNZD',
            'CADCHF',
            'CADJPY',
            'CHFJPY',
            'EURAUD',
            'EURCAD',
            'EURCHF',
            'EURGBP',
            'EURJPY',
            'EURNZD',
            'GBPAUD',
            'GBPCAD',
            'GBPCHF',
            'GBPJPY',
            'GBPNZD',
            'NZDCAD',
            'NZDCHF',
            'NZDJPY',
        ];

        foreach ($pairs as $pair) {
            DB::table('pairs')->insert([
                'pair_name' => $pair,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pairs');
    }
};
