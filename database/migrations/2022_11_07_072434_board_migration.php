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
        //
        Schema::create('boards',function(Blueprint $table){
            $table->id();
            $table->timestamps();
            // $table->softDeletesTz($column = 'deleted_at', $precision = 0)->nullable();
            $table->softDeletes();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->string('content');
            $table->boolean('private');
            $table->boolean('complete')->default(false);
        });

        // Schema::table('boards', function (Blueprint $table) {
        // });
         
        // Schema::table('boards', function (Blueprint $table) {
        //     $table->dropSoftDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
};
