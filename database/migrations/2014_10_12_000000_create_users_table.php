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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('user_type');
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

        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropColumn([
        //         'stripe_id',
        //         'pm_type',
        //         'pm_last_four',
        //     ]);
        // });
    }
}


// php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::table('users', function (Blueprint $table) {
//             $table->string('stripe_id')->nullable()->index();
//             $table->string('pm_type')->nullable();
//             $table->string('pm_last_four', 4)->nullable();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::table('users', function (Blueprint $table) {
//             $table->dropColumn([
//                 'stripe_id',
//                 'pm_type',
//                 'pm_last_four',
//             ]);
//         });
//     }
// };
