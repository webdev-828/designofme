<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('sellername');
            $table->string('selleremail')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username');
            $table->string('password');
            $table->integer('sales');
            $table->float('earning');
            $table->integer('view');
            $table->integer('role');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'sellername' => 'Ali',
                'selleremail' => 'help@designof.me',
                'username' => 'ali',
                // pass=admin_designofme
                'password'=> 'eb98a215ad405a66bd6236f205ecb8a9',
                'sales' => 0,
                'earning' => 0.,
                'view' => 0,
                'role' => 1
            )
        );
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
