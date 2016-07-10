<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLoginsTable extends Migration
{

    private $table = 'user_logins';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false)->unsigned();
            $table->integer('ip_address')->nullable(false);
            $table->text('user_agent')->nullable('false');
            $table->timestamps();

        });

        Schema::table($this->table, function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::drop($this->table);
    }
}
