<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('version', 8)->comment('版本号');
            $table->string('code', 8)->comment('版本code');
            $table->text('content')->nullable()->comment('更新内容');
            $table->string('url')->comment('下载地址');
            $table->boolean('is_force')->unsigned()->default(0)->comment('是否强制更新:0=否,1=是');
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
        Schema::dropIfExists('versions');
    }
}
