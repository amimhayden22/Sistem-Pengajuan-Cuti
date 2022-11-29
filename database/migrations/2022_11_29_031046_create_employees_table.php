<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->char('code', 50);
            $table->string('name', 150);
            $table->string('place_of_birth', 100);
            $table->date('date_of_birth');
            $table->string('email', 150);
            $table->text('address');
            $table->bigInteger('phone');
            $table->string('religion', 150);
            $table->string('education', 150);
            $table->string('bank', 150);
            $table->string('account_number');
            $table->timestamps();

            $table->foreign('position_id')->references('id')->on('positions')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
