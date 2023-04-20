<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsColumnsToCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add created_at and updated_at columns if not exists
        if (!Schema::hasColumn('countries', 'created_at')) {
            Schema::table('countries', function (Blueprint $table) {
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Drop created_at and updated_at columns if not exists
        if (Schema::hasColumn('countries', 'created_at')) {
            Schema::table('countries', function (Blueprint $table) {
                $table->dropTimestamps();
            });
        }
    }
}
