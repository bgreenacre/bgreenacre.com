<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomyTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomy_terms', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('type_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('left_index')->unsigned()->nullable();
            $table->integer('right_index')->unsigned()->nullable();
            $table->integer('level')->unsigned()->nullable();
            $table->string('slug');
            $table->string('name');

            $table->foreign('type_id', 'fk_taxonomy_terms_1')
                ->references('id')
                ->on('types');

            $table->foreign('parent_id', 'fk_taxonomy_terms_2')
                ->references('id')
                ->on('taxonomy_terms');

            $table->foreign('left_index', 'fk_taxonomy_terms_3')
                ->references('id')
                ->on('taxonomy_terms');

            $table->foreign('right_index', 'fk_taxonomy_terms_4')
                ->references('id')
                ->on('taxonomy_terms');

            $table->unique('slug', 'un_taxonomy_terms_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taxonomy_terms', function (Blueprint $table)
        {
            if (Schema::hasColumn('posts', 'fk_posts_1'))
            {
                $table->dropForeign('fk_posts_1');
            }

            if (Schema::hasColumn('posts', 'fk_posts_2'))
            {
                $table->dropForeign('fk_posts_2');
            }

            if (Schema::hasColumn('posts', 'fk_posts_3'))
            {
                $table->dropForeign('fk_posts_3');
            }

            if (Schema::hasColumn('posts', 'fk_posts_4'))
            {
                $table->dropForeign('fk_posts_4');
            }

            if (Schema::hasColumn('posts', 'un_posts_1'))
            {
                $table->dropUnique('un_posts_1');
            }
        });

        Schema::dropIfExists('taxonomy_terms');
    }
}
