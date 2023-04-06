<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            if(Schema::hasColumn('posts', 'body')) {
                $table->dropColumn(['body']);
            }
            if(Schema::hasColumn('posts', 'author_id')) {
                $table->dropColumn(['author_id']);
                $table->foreignId('user_id')->nullable()->after('category_id')->references('id')->on('users');
            }
            if(!Schema::hasColumn('posts', 'content')) {
                $table->text('content')->after('title');
            }
            $table->string('slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {

        });
    }
};
