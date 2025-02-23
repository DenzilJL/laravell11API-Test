<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->double('amount')->nullable();
            $table->enum('status', ['P', 'B', 'V'])->default('B')->comment("P:Paid,B:Billed,V:void");
            $table->enum('active', ['Y', 'N'])->default('Y');
            $table->dateTime('billed_date');
            $table->dateTime('paid_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
