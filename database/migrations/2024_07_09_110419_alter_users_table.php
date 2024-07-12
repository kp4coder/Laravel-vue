<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->after('remember_token')->nullable();
            $table->string('address')->after('phone')->nullable();
            $table->string('website_link')->after('address')->nullable();
            $table->string('github_link')->after('website_link')->nullable();
            $table->string('twitter_link')->after('github_link')->nullable();
            $table->string('instagram_link')->after('twitter_link')->nullable();
            $table->string('facebook_link')->after('instagram_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
