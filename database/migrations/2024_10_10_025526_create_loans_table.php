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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('loan_type_id');
            $table->decimal('loan_amount', 15, 2);
            $table->decimal('remaining_loan', 15, 2)->nullable();
            $table->decimal('interest_rate', 5, 2);
            $table->integer('loan_duration')->nullable(); 
            $table->decimal('installment_amount', 15, 2)->nullable();
            $table->date('due_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
