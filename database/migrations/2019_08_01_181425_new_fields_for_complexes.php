<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewFieldsForComplexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complexes', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('zip');
            $table->string('phone2')->nullable()->after('phone');
            $table->string('toll_free')->nullable()->after('phone2');
            $table->string('website')->nullable()->after('toll_free');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
