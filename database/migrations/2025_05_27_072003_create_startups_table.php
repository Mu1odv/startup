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
        Schema::create('startups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('industry');
            $table->decimal('funding_goal', 15, 2);
            $table->decimal('current_funding', 15, 2)->default(0);
            $table->enum('status', ['draft', 'active', 'funded', 'closed'])->default('draft');
            $table->date('deadline');
            $table->string('founder_name');
            $table->string('founder_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('startups');
    }
};
