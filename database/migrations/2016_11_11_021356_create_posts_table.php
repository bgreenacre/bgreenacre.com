<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('type_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->enum('status', array('publish', 'draft', 'private'))->default('publish');
            $table->string('template')->nullable();
            $table->string('slug');
            $table->string('title');
            $table->string('excerpt', 1000)->nullable();
            $table->text('content');
            $table->dateTime('publish_date');
            $table->integer('order')->nullable();
            $table->boolean('is_in_menu')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('type_id', 'fk_posts_1')
                ->references('id')
                ->on('types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('author_id', 'fk_posts_2')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->index('status', 'in_posts_1');
            $table->index('publish_date', 'in_posts_2');
            $table->index('deleted_at', 'in_posts_3');
            $table->index('order', 'in_posts_4');
            $table->unique('slug', 'un_posts_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function(Blueprint $table)
        {
            if (Schema::hasColumn('posts', 'fk_posts_1'))
            {
                $table->dropForeign('fk_posts_1');
            }

            if (Schema::hasColumn('posts', 'fk_posts_2'))
            {
                $table->dropForeign('fk_posts_2');
            }

            if (Schema::hasColumn('posts', 'in_posts_1'))
            {
                $table->dropForeign('in_posts_1');
            }

            if (Schema::hasColumn('posts', 'in_posts_2'))
            {
                $table->dropForeign('in_posts_2');
            }

            if (Schema::hasColumn('posts', 'in_posts_3'))
            {
                $table->dropForeign('in_posts_3');
            }

            if (Schema::hasColumn('posts', 'in_posts_4'))
            {
                $table->dropIndex('in_posts_4');
            }

            if (Schema::hasColumn('posts', 'un_posts_1'))
            {
                $table->dropForeign('un_posts_1');
            }
        });

        Schema::dropIfExists('posts');
    }
}
