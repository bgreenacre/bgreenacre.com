<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('username', 128);
            $table->string('email');
            $table->string('password');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->unique('username', 'un_users_1');
            $table->unique('email', 'un_users_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            if (Schema::hasColumn('users', 'un_users_1'))
            {
                $table->dropUnique('un_users_1');
            }

            if (Schema::hasColumn('users', 'un_users_2'))
            {
                $table->dropUnique('un_users_2');
            }
        });

        Schema::drop('users');
    }
}
