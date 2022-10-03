<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStayFieldsToUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->integer('beds')->nullable()->after('description');
            $table->integer('sleeps')->nullable()->after('beds');
            $table->integer('baths')->nullable()->after('sleeps');
            $table->boolean('smoking')->default(0)->after('pet_friendly');
            $table->boolean('nest_searchable')->default(0)->after('smoking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumns([
                'beds',
                'sleeps',
                'baths',
                'smoking',
                'nest_searchable',
            ]);
        });
    }
}
