<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('context', 128);

            $table->unique(array('name', 'context'), 'un_types_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('types', function(Blueprint $table)
        {
            if (Schema::hasColumn('types', 'un_types_1'))
            {
                $table->dropUnique('un_types_1');
            }
        });

        Schema::dropIfExists('types');
    }
}
