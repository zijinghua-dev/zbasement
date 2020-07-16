<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreLoginCredentialToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->after('id');
            $table->string('wechat_id')->unique()->nullable(true)->after('uuid');
            $table->string('mobile')->unique()->nullable(true)->after('wechat_id');
            !Schema::hasColumn('users', 'email') && $table->string('email')->unique()->nullable(true)->after('mobile');
            $table->string('username')->unique()->nullable(true)->after('email');
            $table->string('password')
                ->comment('使用mobile、username、email登陆时，对应的密码。其值来源于用户输入')
                ->change();

            $table->dropColumn('name');
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
            $table->dropColumn(['uuid', 'wechat_id', 'mobile', 'email', 'username']);
            !Schema::hasColumn('users', 'name') && $table->string('name');
        });
    }
}
