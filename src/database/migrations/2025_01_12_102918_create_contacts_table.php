<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();  // id: bigint unsigned, PRIMARY KEY, NOT NULL
            $table->unsignedBigInteger('category_id');  // category_id: bigint unsigned, NOT NULL
            $table->string('first_name');  // first_name: varchar(255), NOT NULL
            $table->string('last_name');  // last_name: varchar(255), NOT NULL
            $table->tinyInteger('gender');  // gender: tinyint, NOT NULL
            $table->string('email');  // email: varchar(255), NOT NULL
            $table->string('tel');  // tel: varchar(255), NOT NULL
            $table->string('address');  // address: varchar(255), NOT NULL
            $table->string('building')->nullable();  // building: varchar(255), NULL
            $table->text('detail');  // detail: text, NOT NULL
            $table->timestamps();  // created_at, updated_at: timestamp

            // FOREIGN KEY constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
