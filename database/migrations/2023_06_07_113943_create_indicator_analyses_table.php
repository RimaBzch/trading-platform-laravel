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
        Schema::create('indicator_analyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tool_id');
            $table->foreign('tool_id')->references('id')->on('tools');
            $table->unsignedBigInteger('pair_id');
            $table->foreign('pair_id')->references('id')->on('pairs');
            $table->string('m1', 20)->nullable();
            $table->string('m5', 20)->nullable();
            $table->string('m15', 20)->nullable();
            $table->string('m30', 20)->nullable();
            $table->string('h1', 20)->nullable();
            $table->string('h2', 20)->nullable();
            $table->string('h4', 20)->nullable();
            $table->string('h6', 20)->nullable();
            $table->string('h8', 20)->nullable();
            $table->string('h12', 20)->nullable();
            $table->string('d1', 20)->nullable();
            $table->string('w1', 20)->nullable();
            $table->string('mn', 20)->nullable();
            $table->string('m1_current', 20)->nullable();
            $table->string('m5_current', 20)->nullable();
            $table->string('m15_current', 20)->nullable();
            $table->string('m30_current', 20)->nullable();
            $table->string('h1_current', 20)->nullable();
            $table->string('h2_current', 20)->nullable();
            $table->string('h4_current', 20)->nullable();
            $table->string('h6_current', 20)->nullable();
            $table->string('h8_current', 20)->nullable();
            $table->string('h12_current', 20)->nullable();
            $table->string('d1_current', 20)->nullable();
            $table->string('w1_current', 20)->nullable();
            $table->string('mn_current', 20)->nullable();
            $table->string('m1_last_closed_bar', 20)->nullable();
            $table->string('m5_last_closed_bar', 20)->nullable();
            $table->string('m15_last_closed_bar', 20)->nullable();
            $table->string('m30_last_closed_bar', 20)->nullable();
            $table->string('h1_last_closed_bar', 20)->nullable();
            $table->string('h2_last_closed_bar', 20)->nullable();
            $table->string('h4_last_closed_bar', 20)->nullable();
            $table->string('h6_last_closed_bar', 20)->nullable();
            $table->string('h8_last_closed_bar', 20)->nullable();
            $table->string('h12_last_closed_bar', 20)->nullable();
            $table->string('d1_last_closed_bar', 20)->nullable();
            $table->string('w1_last_closed_bar', 20)->nullable();
            $table->string('mn_last_closed_bar', 20)->nullable();
            $table->string('m1_fl_current', 20)->nullable();
            $table->string('m5_fl_current', 20)->nullable();
            $table->string('m15_fl_current', 20)->nullable();
            $table->string('m30_fl_current', 20)->nullable();
            $table->string('h1_fl_current', 20)->nullable();
            $table->string('h2_fl_current', 20)->nullable();
            $table->string('h4_fl_current', 20)->nullable();
            $table->string('h6_fl_current', 20)->nullable();
            $table->string('h8_fl_current', 20)->nullable();
            $table->string('h12_fl_current', 20)->nullable();
            $table->string('d1_fl_current', 20)->nullable();
            $table->string('w1_fl_current', 20)->nullable();
            $table->string('mn_fl_current', 20)->nullable();
            $table->string('m1_fl_last_closed_bar', 20)->nullable();
            $table->string('m5_fl_last_closed_bar', 20)->nullable();
            $table->string('m15_fl_last_closed_bar', 20)->nullable();
            $table->string('m30_fl_last_closed_bar', 20)->nullable();
            $table->string('h1_fl_last_closed_bar', 20)->nullable();
            $table->string('h2_fl_last_closed_bar', 20)->nullable();
            $table->string('h4_fl_last_closed_bar', 20)->nullable();
            $table->string('h6_fl_last_closed_bar', 20)->nullable();
            $table->string('h8_fl_last_closed_bar', 20)->nullable();
            $table->string('h12_fl_last_closed_bar', 20)->nullable();
            $table->string('d1_fl_last_closed_bar', 20)->nullable();
            $table->string('w1_fl_last_closed_bar', 20)->nullable();
            $table->string('mn_fl_last_closed_bar', 20)->nullable();
            $table->string('m1_sl_current', 20)->nullable();
            $table->string('m5_sl_current', 20)->nullable();
            $table->string('m15_sl_current', 20)->nullable();
            $table->string('m30_sl_current', 20)->nullable();
            $table->string('h1_sl_current', 20)->nullable();
            $table->string('h2_sl_current', 20)->nullable();
            $table->string('h4_sl_current', 20)->nullable();
            $table->string('h6_sl_current', 20)->nullable();
            $table->string('h8_sl_current', 20)->nullable();
            $table->string('d1_sl_current', 20)->nullable();
            $table->string('w1_sl_current', 20)->nullable();
            $table->string('mn_sl_current', 20)->nullable();
            $table->string('m1_sl_last_closed_bar', 20)->nullable();
            $table->string('m5_sl_last_closed_bar', 20)->nullable();
            $table->string('m15_sl_last_closed_bar', 20)->nullable();
            $table->string('m30_sl_last_closed_bar', 20)->nullable();
            $table->string('h1_sl_last_closed_bar', 20)->nullable();
            $table->string('h2_sl_last_closed_bar', 20)->nullable();
            $table->string('h4_sl_last_closed_bar', 20)->nullable();
            $table->string('h6_sl_last_closed_bar', 20)->nullable();
            $table->string('h8_sl_last_closed_bar', 20)->nullable();
            $table->string('d1_sl_last_closed_bar', 20)->nullable();
            $table->string('w1_sl_last_closed_bar', 20)->nullable();
            $table->string('mn_sl_last_closed_bar', 20)->nullable();
            $table->boolean('type_analyse')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicator_analyses');
    }
};
