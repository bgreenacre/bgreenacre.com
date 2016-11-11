<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->timestamps();

            $table->unique('slug', 'un_roles_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function(Blueprint $table)
        {
            if (Schema::hasColumn('roles', 'un_roles_1'))
            {
                $table->dropUnique('un_roles_1');
            }
        });

        Schema::dropIfExists('roles');
    }
}
