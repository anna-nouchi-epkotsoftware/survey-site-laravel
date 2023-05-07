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
        Schema::create('housing_loan_charts', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('name')->comment('名前');
            $table->string('usage_situation')->comment('利用状況');
            $table->string('financial_institution')->comment('住宅金融公庫');
            $table->string('financial_institution2')->comment('地方銀行');
            $table->string('financial_institution3')->comment('みずほ銀行');
            $table->string('financial_institution4')->comment('その他');
            $table->softDeletes()->comment('削除日時'); // deleted_at
            $table->timestamp('created_at')->nullable()->comment('作成日時'); // created_at
            $table->timestamp('updated_at')->nullable()->comment('更新日時'); // updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('housing_loan_charts');
    }
};
