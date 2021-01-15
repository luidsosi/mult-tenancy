<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->decimal('pay_value', 10, 2);
            $table->string('status', 30);
            $table->string('domain', 100);
            $table->string('db_connection', 20);
            $table->string('db_host', 100);
            $table->string('db_port', 10);
            $table->string('db_database', 100);
            $table->string('db_username', 100);
            $table->string('db_password', 100);
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
        Schema::dropIfExists('companies');
    }
}
