<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ユーザーID');
            $table->string('email', 255)->unique()->comment('メールアドレス');
            $table->string('password', 255)->comment('パスワード');
            $table->string('tel', 11)->comment('電話番号');
            $table->string('nick_name', 100)->comment('ニックネーム・チーム名');
            $table->string('last_name', 100)->comment('姓');
            $table->string('first_name', 100)->comment('名');
            $table->string('last_name_kana', 100)->nullable()->comment('姓(カタカナ)');
            $table->string('first_name_kana', 100)->nullable()->comment('名(カタカナ)');
            $table->string('pref', 4)->nullable()->comment('都道府県');
            $table->string('city', 100)->nullable()->comment('市区町村');
            $table->string('town', 100)->nullable()->comment('番地・建物名');
            $table->integer('gender_id')->nullable()->comment('性別ID');
            $table->date('birthdate')->nullable()->comment('生年月日');
            $table->integer('another_contact_type_id')->nullable()->comment('その他連絡先タイプ');
            $table->string('another_contact_info', 255)->nullable()->comment('その他連絡先');
            $table->string('another_tel', 20)->nullable()->comment('その他連絡先:電話番号');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
