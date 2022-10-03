<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->string('type')->after('traveler_id');
            $table->float('amount_charged')->nullable()->after('end_date');
            $table->string('stripe_charge_id')->nullable()->after('amount_charged');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['type', 'amount_charged', 'stripe_charge_id']);
        });
    }
}
