<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsVisitorColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('members', function (Blueprint $table) {
            $table->boolean('is_visitor')->nullable()->after('status');
            $table->boolean('is_alumni')->nullable()->after('status');
            $table->boolean('is_parttime')->nullable()->after('status');
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
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('is_visitor');
            $table->dropColumn('is_alumni');
            $table->dropColumn('is_parttime');
        });
    }
}
