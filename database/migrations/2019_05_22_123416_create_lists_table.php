<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')
                  ->index();
            $table->integer('user_id')
                  ->unsigned()
                  ->index();
            $table->timestamp('scheduled_at')
                  ->index();
            $table->timestamps();
        });

        Schema::table('lists', function (Blueprint $table) {

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('lists');
    }
}
