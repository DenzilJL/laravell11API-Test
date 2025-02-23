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
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact')->nullable();
            $table->text('address')->nullable();
            $table->boolean('status')->comment("1:Active, 0: Inactive")->default(1);
            $table->string('pincode', 6);
        });
    }


};
