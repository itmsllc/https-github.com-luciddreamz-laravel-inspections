<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->increments('id');
            $table->date('insp_date');
            $table->integer('room_number');
            $table->string('room_status');
            $table->date('clean_date');
            $table->string('manager');
            $table->string('supervisor');
            $table->foreign('gra_id')
                ->references('id')->on('gras');
            $table->string('session');
            $table->integer('score');
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
        Schema::drop('inspections');
    }
}
