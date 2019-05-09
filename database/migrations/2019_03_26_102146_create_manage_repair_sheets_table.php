<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManageRepairSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_repair_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable();
            $table->string('modal_name')->nullable();
            $table->text('description')->nullable();
            $table->string('instruction')->nullable();
            $table->string('instruction_caption')->nullable();
            $table->string('cad')->nullable();
            $table->string('enerpac')->nullable();
            $table->string('simplex')->nullable();
            $table->string('power_team')->nullable();
            $table->string('williams')->nullable();
            $table->string('ram-pac')->nullable();
            $table->string('bva')->nullable();
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
        Schema::drop('manage_repair_sheets');
    }
}
