<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('country_id');
            $table->char('code', 2)->nullable(false)->comment('Two-letter country code (ISO 3166-1 alpha-2)');
            $table->string('name', 64)->nullable(false)->comment('English country name');
            $table->string('full_name', 128)->nullable(false)->comment('Full English country name');
            $table->char('iso3', 3)->nullable(false)->comment('Three-letter country code (ISO 3166-1 alpha-3)');
            $table->unsignedSmallInteger('number', 3)->zerofill()->nullable(false)->autoIncrement(false)->comment('Three-digit country number (ISO 3166-1 numeric)');
            $table->char('continent_code', 2)->nullable(false)->comment('Continent code');
            $table->integer('display_order')->default(900)->comment('Display order');
            $table->timestamps();
            $table->unique('code');
            $table->index('continent_code');
            $table->foreign('continent_code')->references('code')->on('continents')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
