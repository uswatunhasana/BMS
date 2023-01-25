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
        Schema::create('history_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->unsignedInteger('created_by')->comment('users.id');
            $table->unsignedInteger('updated_by')->comment('users.id');
            $table->unsignedInteger('tags_id')->comment('tagging_tags.id');

            $table->foreign('tags_id')
                ->references('id')
                ->on('tagging_tags')
                ->onDelete('restrict');

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_tags');
    }
};
