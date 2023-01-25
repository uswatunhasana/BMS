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
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('content');
            $table->bigInteger('parent_id')->nullable();
            $table->tinyInteger('level');
            $table->boolean('isPublished');
            $table->bigInteger('updated_by')->nullable();
            $table->string('name');

            $table->unsignedBigInteger('news_id')->comment('news.id');
            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->onDelete('restrict');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
