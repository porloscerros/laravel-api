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

        Schema::create('accounts_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('accounts_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('group_id')
                ->constrained('accounts_groups');
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('type_id')
                ->constrained('accounts_types');
            $table->foreignId('currency_id')
                ->constrained('currencies');
            $table->double('conversion_rate', 36, 18)->default(1);
            $table->boolean("cash_based_account")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('accounts_types');
        Schema::dropIfExists('accounts_groups');
    }
};
