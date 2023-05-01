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
        Schema::create('daybook_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('daybook_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('daybook_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('daybook', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->foreignId('type_id')
                ->constrained('daybook_types');
            $table->foreignId('item_id')
                ->constrained('daybook_items');
            $table->integer('amount');
            $table->foreignId('currency_id')
                ->constrained('currencies');
            $table->double('conversion_rate', 36, 18)->default(1);
            $table->foreignId('category_id')
                ->constrained('categories');
            $table->foreignId('account_id')
                ->constrained('accounts');
            $table->foreignId('status_id')
                ->constrained('daybook_statuses');
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daybook');
        Schema::dropIfExists('daybook_items');
        Schema::dropIfExists('daybook_statuses');
        Schema::dropIfExists('daybook_types');
    }
};
