<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('name')->comment('名前');
            $table->string('kana_name')->comment('名前（カナ）');
            $table->unsignedSmallInteger('sex_id')->comment('性別ID');
            $table->date('birthday')->comment('誕生日');
            $table->string('email')->comment('メールアドレス');
            $table->string('phone')->comment('電話番号');
            $table->unsignedSmallInteger('job_prefecture_id')->comment('希望勤務都道府県ID');
            $table->unsignedSmallInteger('job_type_id')->comment('希望職種ID');
            $table->text('body')->comment('内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
