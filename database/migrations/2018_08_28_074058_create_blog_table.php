<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('category_id');
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->string('thumbnail');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
        });
        DB::statement('CREATE VIEW view_blogs AS select c.name AS category_name, c.slug AS category_slug, b.title, b.slug, b.content, b.thumbnail, b.updated_at, b.created_at FROM blogs AS b LEFT JOIN categories as c ON b.category_id=c.id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
