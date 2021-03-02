<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document')->unique();       // CPF and CNPJ
            $table->string('name');                     //NAME and COMPANY NAME 
            $table->string('fantasy_name')->nullable(); //FANTASY NAME
            $table->string('rg_ie')->nullable();        // RG and STATE REGISTRATION
            $table->boolean('sex')->nullable();         // SEX
            $table->enum('type', ['F', 'J']);           // PHYSICAL PERSON and LEGAL PERSON
            $table->date('brith');                      // BIRTH DATE and FOUNDATION DATE
            $table->timestamps();
        });

        Schema::create('cotacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('people_id');
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('district')->nullable();
            $table->string('phone')->nullable();
            $table->foreign('people_id')
                        ->references('id')
                        ->on('people')
                        ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotacts');
        Schema::dropIfExists('people');
    }
}
