<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('phone', 50)->unique();
            $table->string('telegram', 20)->unique();
            $table->string('facebook', 50)->unique();
            $table->string('vk', 100)->unique();
            $table->string('skype', 20)->unique();
            $table->string('whatsup', 20)->unique();
            $table->timestamps();

            $table->unique([
                'user_id',
                'phone',
                'telegram',
                'facebook',
                'vk',
                'skype',
                'whatsup'
            ],
                'unique-user_id-socials'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
}
