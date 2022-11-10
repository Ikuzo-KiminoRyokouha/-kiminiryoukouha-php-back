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
        Schema::create('comments',function(Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('content');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade'); //댓글 작성자
            $table->foreignId('target_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade'); //대댓글의 타겟 작성자    
            $table->foreignId('board_id')->constrained('boards')->onUpdate('cascade')->onDelete('cascade'); // 댓글이 속한 게시판
            $table->foreignId('group')->nullable()->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');  //댓글이 속한 구룹s
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
        Schema::dropIfExists('comments');
    }
};
