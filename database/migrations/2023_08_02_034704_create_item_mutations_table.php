<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_mutations', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse');
            $table->string('po_number')->nullable();
            $table->string('letter_number')->nullable(); // no surat jalan
            $table->foreignId('item_id');
            $table->integer('qty_in')->default(0);
            $table->integer('qty_out')->default(0);
            $table->integer('ok')->default(0);
            $table->integer('reject')->default(0);
            $table->date('date_input')->useCurrent();
            $table->date('date_production')->nullable();
            $table->date('date_delivery')->nullable();
            $table->text('description')->nullable();
            $table->string('machine')->nullable();
            $table->string('pic')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_mutations');
    }
};
