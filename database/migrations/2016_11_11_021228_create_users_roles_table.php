<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_roles', function (Blueprint $table)
        {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->primary(array('user_id', 'role_id'));

            $table->foreign('user_id', 'fk_users_roles_1')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('role_id', 'fk_users_roles_2')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_roles', function(Blueprint $table)
        {
            if (Schema::hasColumn('users_roles', 'fk_users_roles_1'))
            {
                $table->dropForeign('fk_users_roles_1');
            }

            if (Schema::hasColumn('users_roles', 'fk_users_roles_2'))
            {
                $table->dropForeign('fk_users_roles_2');
            }
        });

        Schema::dropIfExists('users_roles');
    }
}
