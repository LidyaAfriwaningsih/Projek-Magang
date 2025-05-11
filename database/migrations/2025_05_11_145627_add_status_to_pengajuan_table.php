<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuans', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('pengajuans', 'status')) {
                $table->string('status')->default('menunggu')->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuans', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('pengajuans', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};